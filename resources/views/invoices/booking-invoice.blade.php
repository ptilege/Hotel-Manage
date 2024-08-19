<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>page type</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>

<body style="margin: 0;font-family: 'Montserrat', sans-serif;font-size: 10px;">

    @php
        $booking = App\Models\Booking::find(1);
        $property=App\Models\Property::find($booking->property_id);
    @endphp

<table border="0" style="border-collapse: collapse;width: 100%;margin-left: auto;margin-right: auto;margin-top: 0px;">
    <tr>
        <td width="55%">
            <table border="0" width="100%">
                <tr>
                    <td colspan="2">
                        <p>
                            <span style="font-size: 40px;font-weight: 700;">INVOICE</span>
                            <br>
                            <span style="font-weight: 600;">
                                    <strong>Invoice : </strong> <?php echo $booking->id; ?>
                                <br>
                                    <strong>Date : </strong> <?php echo $booking->created_at; ?>
                            </span>
                        </p>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="font-weight: 600;">
                            <strong style="font-weight: 700;">Invoice to :</strong>
                            <br>
                            <strong style="font-weight: 700;"><?php echo $booking->first_name.' '.$booking->last_name; ?></strong>
                            <br> <?php echo $booking->city; ?>,<?php echo $booking->country; ?>.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="font-weight: 600;line-height: 1.5;">
                            <strong style="font-weight: 700;">Telephone :</strong>  <?php echo $booking->mobile; ?>
                            <br>
                            <strong style="font-weight: 700;">E-mail :</strong> <?php echo $booking->email; ?>
                        </p>
                    </td>
                </tr>

            </table>
        </td>
        <td width="45%">
            <table border="0" width="100%">
                <tr>
                    <td colspan="2">
                        <img src="https://roomista.com/images/logo-dark.png" style="width:300px">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="font-weight: 600;line-height: 1.5;">
                            <strong style="font-size:13px;font-weight: 700;"><?php echo $property->name; ?></strong>
                            <br>
                            <span><?php echo $property->address_1; ?>,
                                <br></span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="20%">
                        <p style="font-weight: 600;line-height: 1.5;"><?php echo $property->phone; ?>
                            <br> <?php echo $property->fax; ?>
                            <br> <?php echo $property->email; ?>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table border="0" style="border-collapse: collapse;width: 100%;margin-left: auto;margin-right: auto;border-top: 1px solid #b9b1b1;border-bottom:1px solid #b9b1b1;">
    <tr>
        <td width="25%">
            <div style="width: 55%;margin:18px auto;border-right: 1px solid #b9b1b1;">
                <p style="margin: 0;font-weight: 600;line-height: 1.5;">
                    <strong style="font-weight: 700;">Check In</strong>
                    <br><?php echo $booking->check_in; ?>
                </p>
            </div>
        </td>
        <td width="25%">
            <div style="width: 66%;margin-top: 18px;margin-bottom: 18px;border-right: 1px solid #b9b1b1;">
                <p style="margin: 0;font-weight: 600;line-height: 1.5;">
                    <strong style="font-weight: 700;">Check Out</strong>
                    <br> <?php echo $booking->check_out; ?>
                </p>
            </div>
        </td>
        
        <td width="25%">
            <div style="width: 66%;margin-top: 18px;margin-bottom: 18px;border-right: 1px solid #b9b1b1;">
                <p style="margin: 0;font-weight: 600;line-height: 1.5;">
                    <strong style="font-weight: 700;">No of Nights</strong>
                    <br> 1 Nights
                </p>
            </div>
        </td>
      
        <td width="25%">
            <div style="width: 100%;margin-top: 18px;margin-bottom: 18px;">
                <p style="margin: 0;font-weight: 600;line-height: 1.5;">
                    <strong style="font-weight: 700;">Payment Method</strong>
                    <br>Visa / Master
                </p>
            </div>
        </td>
        <td width="25%">
            <div style="width: 34%;margin:18px auto;margin-left:0;float: left;">
                <p style="margin: 0;line-height: 1.5;font-weight: 600;color: #Dc0000;text-align: center;background-color:#FFE6E6;width: 100px;border-radius: 5px;padding: 8px 18px;">
                    <strong style="font-weight: 700;"><?php echo $booking->status; ?></strong>
                </p>
            </div>
        </td>
    </tr>
</table>
<table border="0" style="border-collapse: collapse;width: 100%;margin-left: auto;margin-right: auto;">
    <tr>
        <td width="40%">
            <p style="padding: 25px;margin: 0;font-weight: 700;line-height: 1;">Booking Details</p>
        </td>
        <td width="40%">
            <p style="padding: 25px;margin: 0;font-weight: 700;line-height: 1;">Occupancy</p>
        </td>
        <td width="20%">
            <p style="padding: 25px;margin: 0;font-weight: 700;line-height: 1;">Amount</p>
        </td>
    </tr>
    <?php
    $i=0;
    $total = 0;
             foreach($booking->items as $all_data){?>
             <?php $i++ ?>
    <tr>
        <td colspan="3">
            <div style="background-color: #F9F9F9;border: 1px solid #b9b1b1;border-radius: 10px;padding-bottom: 18px;padding-top: 18px;">
                <table width="100%">
                    <tr>
                        <td width="40%" style="border-right: 1px solid #b9b1b1;">
                            <div style="margin-left: auto;margin-right: 0;position: relative;width: 90%;">
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <p style="font-weight: 600;line-height: 1.5;">
                                                <?php echo $all_data->name; ?> [ Super delux / Bread & breackfirst]
                                                <br>
                                                Rooms : number of rooms
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="width:90%;margin-left: 0;margin-right: auto;position: relative;background-color: white;border: 1px solid #b9b1b1;border-radius: 5px;padding-top: 15px;padding-bottom: 15px;margin-bottom: 18px; ">

                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td width="40%" style="border-right: 1px solid #b9b1b1;">
                            <div style="margin-left: auto;margin-right: auto;position: relative;width: 80%;top:-50px;">
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <div style="width:90%;margin-left: 0;margin-right: auto;position: relative;background-color: white;border: 1px solid #b9b1b1;border-radius: 5px;padding-top: 15px;padding-bottom: 15px;top:42px;">

                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td width="20%" style="vertical-align: top;padding-top: 25px;">
                            <table width="100%">

                        </td>
                    </tr>
                    
                    
                     
                </table><br>

            </div>
             <?php if( $i == 2 || $i == 4 || $i == 8){ 
                    echo "<div style='page-break-after: always;'\> </div\>";
                } ?>
        </td>

    </tr>
    <?php if( $i == 2 ){ 
        echo '<style>
                .page-break {
                    page-break-after: always;
                }
            </style>'; 
    } ?>
    
    
    <?php } ?>
</table><br><br>
<table border="1" style="border-collapse: collapse;width: 100%;margin-left: auto;margin-right: auto;">
    <tbody>
    <tr height="30px" style="font-weight: 600; background-color: #d7dbd8;">
        <td colspan="2" align="right" width="70%">
            Service Tax & Government Taxes
        </td>
        <td align="right" width="30%">
            <p style="padding-right: 45px;">10%</p>
        </td>
    </tr>
        
    <!--<tr height="60px">-->
    <!--    <td style="font-weight: 600; background-color: #b8bfba;">-->
    <!--        Service Tax & Government Taxes-->
    <!--    </td>-->
    <!--    <td align="right" style="font-weight: 500; background-color: #b8bfba; ">-->
    <!--        <p style="font-weight: 600;line-height: 1.5;text-align: right;padding-right: 45px;">29%</p>-->
    <!--    </td>-->
    <!--</tr>-->
    <tr height="30px" style="font-weight: 600;   ">
        <td colspan="2" align="right" width="70%">
            Total Tax Charge
        </td>
        <td align="right" width="30%">
            <p style="padding-right: 45px;">LKR 2500</p>
        </td>
    </tr>
    <!--<tr height="30px" style="font-weight: 600; background-color: #d7dbd8; ">-->
    <!--    <td colspan="2" align="right" width="70%">-->
    <!--        Total (without addon & coupon)-->
    <!--    </td>-->
    <!--    <td align="right" width="30%">-->
    <!--        <p style="padding-right: 45px;">LKR100</p>-->
    <!--    </td>-->
    <!--</tr>-->
    <!--<tr height="30px" style="font-weight: 600; ">-->
    <!--    <td colspan="2" align="right" width="70%">-->
    <!--        Added Addons-->
    <!--    </td>-->
    <!--    <td align="right" width="30%">-->
    <!--        <p style="padding-right: 45px;">LKR100</p>-->
    <!--    </td>-->
    <!--</tr>-->
    
    <!--<tr height="30px" style="font-weight: 600; background-color: #d7dbd8;">-->
    <!--    <td colspan="2" align="right" width="70%">-->
    <!--         Discount-->
    <!--    </td>-->
    <!--    <td align="right" width="30%">-->
    <!--        <p style="padding-right: 45px;">LKR100</p>-->
    <!--    </td>-->
    <!--</tr>-->
    <tr height="30px" style="font-weight: 700;">
        <td colspan="2" align="right" width="70%">
            Grand Total
        </td>
        <td align="right" width="30%">
            <p style="padding-right: 45px;">LKR100</p>
        </td>
    </tr>
    <tr height="30px" style="border-bottom: 1px solid #b9b1b1;border-top: 1px solid #b9b1b1;font-weight: 700; background-color: #d7dbd8;">
        <td colspan="2" align="right" width="70%">
            Partial Amount
        </td>
        <td align="right" width="30%">
            <p style="padding-right: 45px;">LKR100</p>
        </td>
    </tr>
    <tr height="30px" style="border-bottom: 1px solid #b9b1b1;border-top: 1px solid #b9b1b1;font-weight: 700;">
        <td colspan="2" align="right" width="70%">
            Amount Due
        </td>
        <td align="right" width="30%">
            <p style="padding-right: 45px;">LKR100</p>
        </td>
    </tr>
    </tbody>
</table>
<br><br><br>
<p style="text-align: center;margin-left: auto;margin-right: auto;font-size: 10px;font-weight: 600;width: 75%;">
    Please note that this is a computer generated report. do not reply to this email. This mailbox is not monitored
    and you will not receive a response. Do you really need to print this document? If yes, please print only the
    pages you need. Help make a difference, save paper, help save the planet. &copy; My property :: Online Hotel
</p>

<p style="text-align: center;margin-left: auto;margin-right: auto;font-size: 10px;font-weight: 600;width: 75%;margin-bottom: -50%;">
    Booking Engine <?php echo date("Y"); ?> . All rights Reserved. Software by <b>roomitra.com</b>
</p>

</body>

</html>