<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Timesheet PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo ASSETS ?>/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesome CSS -->
    <link href="<?php echo ASSETS ?>/assets/node_modules/font-awesome/font-awesome.min.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- Custom CSS -->
    <link href="<?php echo ASSETS ?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo ASSETS ?>/css/colors/default.css" id="theme" rel="stylesheet">
    <style>
        .timesheet_table{
            width: 100%;
            border: 1px solid #20aee3;
            padding: 0;
            margin: 0;
        }

        .timesheet_data td{
            text-align:center;
            border: 1px solid #20aee3;
        }

        .timesheet_header {
            background-color: #20aee3;
            color: #fff;
        }
    </style>
</head>
<?php $counter = 0; ?>
<body>
    <h2>Timesheet PDF</h2>
    <table class="timesheet_table">
        <thead class="timesheet_header">
            <th>Client Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>In</th>
            <th>Out</th>
            <th>ETC</th>
            <th>Hours</th>
        </thead>
        <tbody>
            <?php
            $rendered = '00:00';
            $etc = '00:00';
            ?>
            <?php foreach($timesheet as $key => $value){ 
                $counter++;
                
                ?>
                <tr class="timesheet_data <?= ($counter % 2 == 0) ? 'evenrow' : 'oddrow' ?>">
                    <td><?= $value->name ?></td>
                    <td><?= date('F d, Y' ,strtotime($value->date))?></td>
                    <td><?= date('h:i a' ,strtotime($value->time_start)) .' - '. date('h:i a' ,strtotime($value->time_end)) ?></td>
                    <td><?= ($value->clock_in == NULL) ? '-' : date('h:i a', strtotime($value->clock_in)) ?></td>
                    <td><?= ($value->clock_out == NULL) ? '-' : date('h:i a', strtotime($value->clock_out)) ?></td>
                    <td>
                        <?php 
                            $start = strtotime($value->time_start);
                            $end = strtotime($value->time_end);

                            $hours = date('H:i:s', $end-$start);
                            $duration = $end-$start;
                            $hours = (int)($duration/60/60);
                            $minutes = (int)($duration/60)-$hours*60;
                            $hours = ($hours <= 9) ? '0'.$hours : $hours;
                            $minutes = ($minutes <= 9) ? '0'.$minutes : $minutes;
                            $etc = date('H:i', strtotime($etc."+$hours hours +$minutes minutes"));
                            
                            // $total_etc += date('h:i',strtotime("$hours:$minutes"));
                            echo $hours." hrs ".$minutes." mins";
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($value->clock_in != NULL && $value->clock_out != NULL){
                                $start = strtotime($value->clock_in);
                                $end = strtotime($value->clock_out);

                                $hours = date('H:i:s', $end-$start);
                                $duration = $end-$start;
                                $hours = (int)($duration/60/60);
                                $minutes = (int)($duration/60)-$hours*60;
                                $hours = ($hours <= 9) ? '0'.$hours : $hours;
                                $minutes = ($minutes <= 9) ? '0'.$minutes : $minutes;
                                $rendered = date('H:i', strtotime($rendered."+$hours hours +$minutes minutes"));

                                echo $hours." hrs ".$minutes." mins"; 
                            }else{
                                echo "-";
                            } 
                        ?>
                    </td>
                </tr>
            <?php } ?>
            <tr class="timesheet_data evenrow" style="text-align:right !important">
                <td colspan="5">Total</td>
                <td><?= $etc ?></td>
                <td><?= $rendered ?></td>
            </tr>
        </tbody>
    </table>
  </div>
</body>
</html>