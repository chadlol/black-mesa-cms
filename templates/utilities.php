<?php
/**
 * @param $month
 * @param $year
 */
function calendar($month, $year)
{
    $first_day_month = mktime(0, 0, 0, $month, 1, $year);
    $first_day_week = strftime("%w", $first_day_month);
    $full_month = strftime('%B', $first_day_month);

    if ($month == 1) {
        $prev_month = 12;
        $prev_year = $year - 1;
    } else {
        $prev_month = $month - 1;
        $prev_year = $year;
    }

    if ($month == 12) {
        $next_month = 1;
        $next_year = $year + 1;
    } else {
        $next_month = $month + 1;
        $next_year = $year;
    }


    $previous_month_link = "<a href='/calendar.php?month=$prev_month&amp;year=$prev_year'>Previous</a>";
    $next_month_link = "<a href='/calendar.php?month=$next_month&amp;year=$next_year'>Next</a>";
    $num_days = cal_days_in_month(0, $month, $year);
    $week = 7;

    echo '<table>';

    echo "<caption>$full_month, $year</caption>";
    $day = 0;
    echo "<tr><td>$previous_month_link</td>";
    echo "<td></td><td></td><td></td><td></td><td></td><td>$next_month_link</td></tr>";
    echo "<tr><td><b>Sun</b></td>
              <td><b>Mon</b></td>
              <td><b>Tue</b></td>
              <td><b>Wed</b></td>
              <td><b>Thu</b></td>
              <td><b>Fri</b></td>
              <td><b>Sat</b></td>";
    echo "</tr>";

    echo "<tr>";
    while ($day < $first_day_week) {
        echo "<td>&nbsp;</td>";
        $day++;
    }

    $day = 1;

    while ($day <= $week - $first_day_week) {
        if ($day > $num_days) {

            echo "<td>&nbsp;</td>";
        } else {
            echo "<td>$day</td>";
        }
        $day++;

        if ($day - 1 == $week - $first_day_week && $week - $first_day_week <= $num_days) {

            $week = $week + 7;

            echo "</tr><tr>";
        }

    }


    echo "</tr>";


    echo "</table>";
}

//				echo "<br/> Today is $month/$day of $year";
//				echo "<br/>$time";
//				echo "<br/>$first_day_month";
//				echo "<br/>The first day of the month is " . strftime('%A, %b/%d/%y', $first_day_month);
?>