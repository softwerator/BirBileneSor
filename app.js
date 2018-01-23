function api_address(){ return "http://192.168.1.1/80"; }

function goHomePageIfNotAUth(){
    if(localStorage.getItem('token') == null){
        location.href = 'questions.html';
    }
}

function getQuestionsTotal(num){
    document.getElementById("countsay").innerHTML = num;
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).ready(function () {

    console.log(localStorage.getItem("token"));
    if (localStorage.getItem("token") != null) {
        $("#kayitOl").hide();
        $("#girisYap").text("Çıkış Yap");
        $("#girisYap").attr("logged", "true");
    } else {
        $("#kayitOl").show();
        $("#girisYap").text("Giriş Yap");
        $("#girisYap").attr("logged", "false");
    }


    $("#girisYap[logged='true']").click(function (e) {
        e.preventDefault();
        console.log(localStorage.getItem("token"));
        $.ajax({
            type: 'GET',
            url: api_address() + "/api/logout",
            data: { 'token': localStorage.getItem("token") },
            dataType: "json",
            success: function (data) {
                localStorage.removeItem("token");
                location.href = 'questions.html';
            },
            error: function (data) {
                console.log("error");
                console.log(data);
            }
        });
    })
})