setInterval(displayTime, 1000);

function displayTime() {

    const timeNow = new Date();

    let hoursOfDay = timeNow.getHours();
    let minutes = timeNow.getMinutes();
    let seconds = timeNow.getSeconds();

    if (hoursOfDay > 12) {
        hoursOfDay-= 12;
        period = " PM";
    }

    if (hoursOfDay === 0) {
        hoursOfDay = 12;
        period = "AM";
    }

    hoursOfDay = hoursOfDay < 10 ? "0" + hoursOfDay : hoursOfDay;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    let time = hoursOfDay + ":" + minutes + ":" + seconds + period;

    document.getElementById('myClock').innerHTML = time + " ";

}

function darkMode() {
    var element = document.body;
    var content = document.getElementById("darkModeText");
    element.className = "dark-mode";
}

function lightMode() {
    var element = document.body;
    var content = document.getElementById("darkModeText");
    element.className = "light-mode";
}

displayTime();