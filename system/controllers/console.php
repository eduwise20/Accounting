<?php

/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
|
*/

$c_ckey = $config['ckey'];
$r_ckey = $routes['1'];

if($c_ckey == '0982995697')
{
    exit('For security reason, please generate a new key');
}

if($c_ckey != $r_ckey){
    exit('Access Denied.');
}

@ini_set('memory_limit', '512M');
@ini_set('max_execution_time', 0);
@set_time_limit(0);

//check schedule jobs already run
$today = date('Y-m-d');
$d = ORM::for_table('sys_schedulelogs')->where('date',$today)->find_one();
if($d){
    echo 'application Schedule Jobs already run for today: '.$today;

}
else{
    $email_config = EmailConfig::first();


    $syslogs = '';
    $syslogs .= '================================================== <br>';
    $syslogs .= date('Y-m-d H:i:s').' : Schedule Jobs Started....... <br>';

    $msg = '';
    $arcs = array();
    $cs = ORM::for_table('sys_schedule')->find_many();
    foreach($cs as $rcs)
    {
        $arcs[$rcs['cname']]=$rcs['val'];
    }

    if(($arcs['accounting_snapshot']) == 'Active'){
        $syslogs .= date('Y-m-d H:i:s').' : Creating Accounting Snapshot <br>';
        $last_day = date('Y-m-d', strtotime('Yesterday'));
        $msg .= 'Accounting Snaphsot - Date: '.$last_day.'<br>';
        $last_day_income = ORM::for_table('sys_transactions')->where('date',$last_day)->sum('cr');
        if($last_day_income == ''){
            $last_day_income = '0.00';
        }

        $msg .= 'Total Income: '.ib_money_format($last_day_income,$config).'<br>';

        $last_day_expense = ORM::for_table('sys_transactions')->where('date',$last_day)->sum('dr');
        if($last_day_expense == ''){
            $last_day_expense = '0.00';
        }

        $msg .= 'Total Expense: '.ib_money_format($last_day_expense,$config).'<br>';

        // echo $msg;
        $syslogs .= date('Y-m-d H:i:s').' : Accounting Snapshot created! <br>';
        $syslogs .= '=============== Accounting Snaphsot ==================== <br>';
        $syslogs .= $msg;
        $syslogs .= '================================================== <br>';



    }

//  ============================ For Invoice =======================================================================
    if(($arcs['recurring_invoice']) == 'Active'){

        $syslogs .= date('Y-m-d H:i:s').' : Creating Recurring Invoice <br>';

        //find all invoice that nd = today
        $its = strtotime($today);

$i = ORM::for_table('sys_invoices')->where_not_equal('r','0')->where('nd',$today)->find_many();
        $c = 0;
        foreach($i as $is){


            $cn = str_pad($config['invoice_code_current_number'], $config['number_pad'], '0', STR_PAD_LEFT);

            $iid = $is['id'];
            $r = $is['r'];
            $pdd = strtotime($is['duedate']);
            $dd = date('Y-m-d',strtotime($r,$pdd));
            $nd = date('Y-m-d',strtotime($r,$its));
            $vtoken = _raid(10);
            $ptoken = _raid(10);
            $d = ORM::for_table('sys_invoices')->create();
            $d->userid = $is['userid'];
            $d->account = $is['account'];
            $d->date = $today;
            $d->duedate = $dd;
            $d->subtotal = $is['subtotal'];
            $d->total = $is['total'];
            $d->tax = $is['tax'];
            $d->taxname = $is['taxname'];
            $d->taxrate = $is['taxrate'];
            $d->vtoken = $vtoken;
            $d->ptoken = $ptoken;
            $d->status = 'Unpaid';
            $d->notes = $is['notes'];
            $d->currency_iso_code = $is['currency_iso_code'];
            $d->r = $r;
            $d->nd = $nd;
            $d->is_same_state = $is['is_same_state'];
            //others
          //  $d->invoicenum = $is['invoicenum'];
            $d->invoicenum = $config['invoice_code_prefix'];
          //  $d->cn = $is['cn'];
            $d->cn = $cn;

            update_option('invoice_code_current_number',current_number_would_be($cn));


            $d->tax2 = '0.00';
            $d->taxrate2 = '0.00';
            $d->paymentmethod = '';
            $d->save();

            $invoiceid = $d->id();

            if ($cn != '') {
                $dispid = $cn;
            }
            else {
                $dispid = $invoiceid;
            }

            $in = $config['invoice_code_prefix'] . $dispid;



            //set previous invoice r 0
            $s = ORM::for_table('sys_invoices')->find_one($iid);
            $s->r = '0';
            $s->save();
$c++;
            //create items from old data
            $items = ORM::for_table('sys_invoiceitems')->where('invoiceid',$iid)->order_by_asc('id')->find_many();
            foreach($items as $item){
                $t = ORM::for_table('sys_invoiceitems')->create();
                $t->invoiceid = $invoiceid;
                $t->userid = $item['userid'];
                $t->description = $item['description'];
                $t->qty = $item['qty'];
                $t->amount = $item['amount'];
                $t->total = $item['total'];
                $t->relid = 0;
                $t->type = '';
                $t->taxed = $item['taxed'];
                $t->save();
            }



            if($config['console_notify_invoice_created'] == '1'){
                $msg = Invoice::gen_email($invoiceid,'created');
                $subject = $msg['subject'];
                $body = $msg['body'];
                $email = $msg['email'];
                $name = $msg['name'];
                $cid = $msg['cid'];

//                Notify_Email::_send($name, $email, $subject, $message, $cid, $invoiceid);


                if($email_config)
                {

                    if($email_config->method == 'smtp')
                    {
                        $transport = (new Swift_SmtpTransport($email_config->host, $email_config->port,$email_config->secure))
                            ->setUsername($email_config->username)
                            ->setPassword($email_config->password)
                            ->setStreamOptions([
                                'ssl' => [
                                    'allow_self_signed' => true,
                                    'verify_peer' => false
                                ]
                            ]);
                    }
                    else{
                        $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
                    }


                    $mailer = new Swift_Mailer($transport);

                    $receiver = [];

                    $receiver[] = [
                        $email => $name
                    ];



                    $message = (new Swift_Message($subject))
                        ->setFrom([$config['sysEmail'] => $config['CompanyName']])
                        ->setTo([$email => $name])
                        ->setBody($body,'text/html')
                    ;




                    Invoice::pdf($invoiceid, 'store');



                    $attachment_path = 'storage/temp/Invoice_' . $in . '.pdf';
                    $attachment_file = 'Invoice_' . $in . '.pdf';

                    if($attachment_path != '')
                    {
                        $message->attach(Swift_Attachment::fromPath($attachment_path));
                    }



                    $result = $mailer->send($message);




                }

            }



        }
        // echo $msg;
        $syslogs .= date('Y-m-d H:i:s').' : '.$c.' Invoice created! <br>';

        //Send Email Invoice Created





        $syslogs .= '================================================== <br>';

    }


    // Automatic files backup






    $l = ORM::for_table('sys_schedulelogs')->create();
    $l->date = $today;
    $l->logs = $syslogs;
    $l->save();

    if(($arcs['notify']) == 'Active') {

        Notify_Email::_send($config['CompanyName'],$arcs['notifyemail'],$config['CompanyName'].' Automation Activity',$syslogs);
    }

    echo $syslogs;
}

