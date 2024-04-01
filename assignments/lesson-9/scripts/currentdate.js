function todaydate()
{
    var completeDate = "Today";
    var weekDay = "Today";
    var month = "This month";
    var today_date= new Date();
    var dayOfWeek = today_date.getDay();
    var myyear=today_date.getFullYear();
    var mymonth=today_date.getMonth()+1;
    var dayOfMonth=today_date.getDate();

    switch(dayOfWeek){
        case 0: weekDay = "Sunday";
            break;
        case 1: weekDay = "Monday";
            break;
        case 2: weekDay = "Tuesday";
            break;
        case 3: weekDay = "Wednesday";
            break;
        case 4: weekDay = "Thursday";
            break;
        case 5: weekDay = "Friday";
            break;
        case 6: weekDay = "Saturday";
            break;
    }

    switch(mymonth){
        case 1: month = "January";
            break;
        case 2: month = "February";
            break;
        case 3: month = "March";
            break;
        case 4: month = "April";
            break;
        case 5: month = "May";
            break;
        case 6: month = "June";
            break;
        case 7: month = "July";
            break;
        case 8: month = "August";
            break;
        case 9: month = "September";
            break;
        case 10: month = "October";
            break;
        case 11: month = "November";
            break;
        case 12: month = "December";
            break;
    }

    completeDate = (weekDay+", "+dayOfMonth+" "+month+" "+myyear);
    document.getElementById("dateToday").innerHTML = completeDate;
}
