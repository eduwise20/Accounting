    <page><table class="table-container">
        <thead>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td width="150" style="padding-right:10px;">
                                <img src="{$app_url}ui/lib/img/trust-1-1.png" width="150" alt="trust-1-1"
                                    border="0" />
                            </td>
                            <td>
                                <h1>Eduwise School Nepal</h1>
                                <p style="margin-top:20px;">Kathmandu, Nepal</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table class="table-billing table-fluid">
                        <tbody>
                            <tr>
                                <td style="border-bottom:1px solid black;">
                                    <table class="table-fee-receipt-section table-fluid" style="padding-top:5px;padding-bottom:5px;padding-left:5px;">
                                        <tr>
                                            <th style="width: 250px; text-align: left;">Fee Receipt</th>
                                            <th style="width: 250px; text-align: center;">Receipt No. {$student_list_count}</th>
                                            <th style="width: 240px; text-align: right;">Date: {$date}</th>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="border-bottom:1px solid black;">
                                    <table class="table-fluid" style="padding-top:5px;padding-bottom:5px;padding-left:5px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 400px; text-align: left;">
                                                    <table>
                                                        <tbody>
                                                            <tr style="margin-bottom:5px;">
                                                                <td style="width: 170px;">Student Name: </td>
                                                                <td><b>{$student->name}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 170px;">Admission No: </td>
                                                                <td>{$student->admission_no}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 170px;">Finance Fee Collection: </td>
                                                                <td>Monthly Fee</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td style="text-align: left;">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Class:</td>
                                                                <td>{$class->name}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Parent: </td>
                                                                <td>{if $student_additional_info->parent_name == null}
                                                                        N/A
                                                                    {elseif $student_additional_info->parent_name != null}
                                                                        {$student_additional_info->parent_name}
                                                                    {/if}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Due Date: </td>
                                                                <td>30/02/2021</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="border-bottom:1px solid black;">
                                    <table class="table-fluid table-account" style="padding-top:5px;padding-bottom:5px;padding-left:5px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 660px; text-align: left;"><b>Particulars</b></td>
                                                <td style="text-align: right;">
                                                    <b>Amount (Rs.)</b>
                                                </td>
                                            </tr>
                                            {$count = 1}
                                            {foreach $fees as $fee_name => $fee_value}
                                             {if $fee_value != 0 }
                                                <tr>
                                                    <td>{$count}. {$fee_name}</td>
                                                    <td style="text-align:right;">{$fee_value}</td>
                                                    {$count = $count + 1}
                                                </tr>
                                             {/if}   
                                            {/foreach}
                                            {if isset($fines) && sizeof($fines) > 0 && $student_total_fine != 0}
                                                <tr style="margin-top:10px;">
                                                    <td><b>Fines</b></td>
                                                    <td style="text-align:right;"><b>Amount (Rs.)</b></td>
                                                </tr>
                                                {$count = 1}
                                                {foreach $fines as $fine_name => $fine_value}
                                                {if $fine_value != 0 }
                                                    <tr>
                                                    
                                                        <td>{$count}. {$fine_name}</td>
                                                        <td style="text-align:right;">{$fine_value}</td>
                                                        {$count = $count + 1}
                                                    </tr>
                                                {/if}    
                                                {/foreach}
                                            {/if}
                                            {if isset($discounts) && sizeof($discounts) > 0 && $student_total_discount != 0}
                                                <tr>
                                                    <td><b>Discounts</b></td>
                                                    <td><b>Amount (Rs.)</b></td>
                                                </tr>
                                                {$count = 1}
                                                {foreach $discounts as $discount_name => $discount_value}
                                                {if $discount_value != 0 }
                                                    <tr>
                                                        <td>{$count}. {$discount_name}</td>
                                                        <td style="text-align:right;">{$discount_value}</td>
                                                        {$count = $count + 1}
                                                    </tr>
                                                {/if}
                                                {/foreach}
                                            {/if}
                                            {if isset($scholarships) && sizeof($scholarships) > 0 && $student_total_scholarship != 0}
                                                <tr>
                                                    <td><b>Scholarshps</b></td>
                                                    <td><b>Amount (Rs.)</b></td>
                                                </tr>
                                                {$count = 1}
                                                {foreach $scholarships as $scholarship_name => $scholarship_value}
                                                    {if $scholarship_value != 0 }
                                                    <tr>
                                                        <td>{$count}. {$scholarship_name}</td>
                                                        <td style="text-align:right;">{$scholarship_value}</td>
                                                        {$count = $count + 1}
                                                    </tr>
                                                    {/if}
                                                {/foreach}
                                            {/if}
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom:1px solid black;">
                                    <table class="table-fluid table-account" style="padding-top:5px;padding-bottom:5px;padding-left:5px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 660px; text-align: left;"><b>Summary</b></td>
                                                <td style="text-align: right;"><b>Amount (Rs.)</b></td>
                                            </tr>
                                            <tr>
                                                <td>1. Total Fees</td>
                                                <td style="text-align:right;">{$student_total_fee}</td>
                                            </tr>
                                            {if $student_total_fine != 0 }
                                            <tr>
                                                <td>2. Total Fines</td>
                                                <td style="text-align:right;">{$student_total_fine}</td>
                                            </tr>
                                            {/if}

                                            {if $student_total_discount != 0 }
                                            <tr>
                                                <td>3. Total Discounts</td>
                                                <td style="text-align:right;">{$student_total_discount}</td>
                                            </tr>
                                            {/if}

                                            {if $student_total_scholarship != 0 }
                                            <tr>
                                                <td>4. Total Scholarships</td>
                                                <td style="text-align:right;">{$student_total_scholarship}</td>
                                            </tr>
                                            {/if}
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom:1px solid black;">
                                    <table class="table-fluid" style="padding-top:5px;padding-bottom:5px;padding-left:5px;">
                                        <tbody>
                                            <tr>
                                               <td style="width: 575px; text-align: left;">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:150px;">Payment mode</td>
                                                                <td>Cash</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td text-align: left;">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Total amount to pay</td>
                                                                <td>{$total_fee}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <table class="table-fluid" style="padding-top:5px;padding-bottom:5px;padding-left:5px;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 575px; text-align: left;">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:120px;"><b>Amount in Words: </b></td>
                                                                <td>
                                                                    {$amount_in_words}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td style="text-align: right;">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Total amount paid</b></td>
                                                                <td>{$total_fee}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="padding-top:20px;">Fees must be paid in full within the end of every month</td>
            </tr>
        </tfoot>
    </table>
    </page>