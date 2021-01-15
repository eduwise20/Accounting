<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Billing</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        font-family: "Arial";
        box-sizing: border-box;
    }

    table {
        border-spacing: 15px;
    }

    table,
    th,
    td {
        border: none;
        padding: 10px;
        border-collapse: collapse;
    }

    .table-container {
        max-width: 100%;
        margin: 0 auto;
        width: 100%;
    }

    .table-billing,
    .table-billing>tbody>tr>td,
    .table-billing>tbody>tr>th {
        border: 1px solid black;
        padding: 0 !important;
    }

    .table-fluid {
        width: 100%;
    }

    .table-account td:last-child {
        text-align: right;
    }
</style>

<body>
    <table class="table-container">
        <thead>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td width="150">
                                <img src="https://i.ibb.co/bgrnkfz/trust-1-1.png" width="150" alt="trust-1-1"
                                    border="0" />
                            </td>
                            <td>
                                <h1>Eduwise School Nepal</h1>
                                <p>Kathmandu, Nepal</p>
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
                                <td>
                                    <table class="table-fluid">
                                        <tr>
                                            <th align="left">Fee Receipt</th>
                                            <th align="center">Receipt No. 10</th>
                                            <th align="right">Date: {$date}</th>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <table class="table-fluid">
                                        <tbody>
                                            <tr>
                                                <td align="left">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Student Name</td>
                                                                <td><b>{$student->name}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Admission No</td>
                                                                <td>{$student->admission_no}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Finance Fee Collection</td>
                                                                <td>Monthly Fee</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td align="right">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Class</td>
                                                                <td>{$class->name}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Parent</td>
                                                                <td>{$student_additional_info->parent_name}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Due Date</td>
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
                                <td>
                                    <table class="table-fluid table-account">
                                        <tbody>
                                            <tr>
                                                <td><b>Particulars</b></td>
                                                <td><b>Amount (Rs.)</b></td>
                                            </tr>
                                            {$count = 1}
                                            {foreach $fees as $fee_name => $fee_value}
                                                <tr>
                                                    <td>{$count}. {$fee_name}</td>
                                                    <td>{$fee_value}</td>
                                                    {$count = $count + 1}
                                                </tr>
                                            {/foreach}
                                            {if isset($fines) && sizeof($fines) > 0}
                                                <tr>
                                                    <td><b>Fines</b></td>
                                                    <td><b>Amount (Rs.)</b></td>
                                                </tr>
                                                {$count = 1}
                                                {foreach $fines as $fine_name => $fine_value}
                                                    <tr>
                                                        <td>{$count}. {$fine_name}</td>
                                                        <td>{$fine_value}</td>
                                                        {$count = $count + 1}
                                                    </tr>
                                                {/foreach}
                                            {/if}
                                            {if isset($discounts) && sizeof($discounts) > 0}
                                                <tr>
                                                    <td><b>Discounts</b></td>
                                                    <td><b>Amount (Rs.)</b></td>
                                                </tr>
                                                {$count = 1}
                                                {foreach $discounts as $discount_name => $discount_value}
                                                    <tr>
                                                        <td>{$count}. {$discount_name}</td>
                                                        <td>{$discount_value}</td>
                                                        {$count = $count + 1}
                                                    </tr>
                                                {/foreach}
                                            {/if}
                                            {if isset($scholarships) && sizeof($scholarships) > 0}
                                                <tr>
                                                    <td><b>Scholarshps</b></td>
                                                    <td><b>Amount (Rs.)</b></td>
                                                </tr>
                                                {$count = 1}
                                                {foreach $scholarships as $scholarship_name => $scholarship_value}
                                                    <tr>
                                                        <td>{$count}. {$scholarship_name}</td>
                                                        <td>{$scholarship_value}</td>
                                                        {$count = $count + 1}
                                                    </tr>
                                                {/foreach}
                                            {/if}
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table-fluid table-account">
                                        <tbody>
                                            <tr>
                                                <td><b>Summary</b></td>
                                                <td width="300"><b>Amount (Rs.)</b></td>
                                            </tr>
                                            <tr>
                                                <td>1. Total Fees</td>
                                                <td>{$student_total_fee}</td>
                                            </tr>
                                            <tr>
                                                <td>2. Total Fines</td>
                                                <td>{$student_total_fine}</td>
                                            </tr>
                                            <tr>
                                                <td>3. Total Discounts</td>
                                                <td>{$student_total_discount}</td>
                                            </tr>
                                            <tr>
                                                <td>4. Total Scholarships</td>
                                                <td>{$student_total_scholarship}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table-fluid">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Payment mode</td>
                                                                <td>Cash</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td align="right">
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
                                    <table class="table-fluid">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Amount in Words</b></td>
                                                                <td>
                                                                    {$amount_in_words}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td align="right">
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
                <td>Fees must be paid in full within the end of every month</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>