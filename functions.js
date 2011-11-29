function validateDate(strDate){
   if (new Date(strDate) == "Invalid Date")
       return false;
   else
       return true;

}

function apmps(){
    $("#filter").remove();
    $.ajax({
        url: "AjaxActions/User/apmps.php",
        success: function(data){
            $("#panels1").append(data);
        }
    });
}

function ppav(){
    $("#filter").remove();
    $.ajax({
        url: "AjaxActions/User/ppav.php",
        success: function(data){
            $("#panels1").append(data);
        }
    });
}

function analizeapmps(){
    var data = $("#data").val();
    $("#message").text("");
    if(data.length == 7){
        if(validateDate(data)){
            var img1 = document.getElementById("chart1");
            var img2 = document.getElementById("chart2");
            img1.src = "Design/images/loading.gif";
            img2.src = "Design/images/loading.gif";
            img1.src = "Utilities/Charts.php?chart=padaliniu_paraiskos&menuo=" + data;
            img2.src = "Utilities/Charts.php?chart=is_paraiskos&menuo=" + data;
        }else{
            $("#message").text("Neteisingas datos formatas!").css("color", "red");
        }
    }else{
        $("#message").text("Neteisingas datos formatas!").css("color", "red");
    }
}

function analizeppav(){
    var nuo = $("#data1").val();
    var iki = $("#data2").val();
    $("#message").text("");
    if(nuo.length == 7 && iki.length == 7){
        if(validateDate(nuo)){
            if(validateDate(iki)){
                var img1 = document.getElementById("chart1");
                var img2 = document.getElementById("chart2");
                img1.src = "Design/images/loading.gif";
                img2.src = "Design/images/loading.gif";
                img1.src = "Utilities/Charts.php?chart=padaliniu_valandos&menuoNuo=" + nuo + "&menuoIki=" + iki;
                img2.src = "Utilities/Charts.php?chart=is_valandos&menuoNuo=" + nuo + "&menuoIki=" + iki;
            }else{
                $("#message").text("Neteisingas datos formatas!").css("color", "red");
            }
        }else{
            $("#message").text("Neteisingas datos formatas!").css("color", "red");
        }
    }else{
        $("#message").text("Neteisingas datos formatas!").css("color", "red");
    }
}

(function () {
    $(document).ready(ready);
})();

function ready() {
    $('#prognozes > li').click(function () {
       $(this).toggleClass("active"); 
    });
    
    $('#search-submit').click(function () {
        var els = [ ];
        
        $('#prognozes > .active').each(function () {
            els.push($(this).attr("id"))
        });
        
        alert(els.join(", "));
    });
    
    $('#data').live("keydown", function (event) {
        if (event.keyCode == 13)
            analizeapmps();
    });
}