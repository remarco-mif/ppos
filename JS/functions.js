var img1_width = 548;
var img1_height = 200;
var img2_width = 548;
var img2_height = 200;

function fileUpload(){
    
}

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

function setImage(diagrama, id, paramosPriemones, duom, width, height){
    var img = document.getElementById(id);
    var tipas = "is";
    var w = 0;
    var h = 0;
    if(width != null){
        img.width = width;
    }
    if(height != null){
        img.height = height;
    }
    img.src = "Design/images/loading.gif";
    if(diagrama == "is_prognoze"){
        tipas = "is";
        w = img2_width;
        h = img2_height;
    }else{
        tipas = "padaliniai";
        w = img1_width;
        h = img1_height;
    }
    img.src = "Utilities/Charts.php?chart=" + diagrama + "&paramos_priemones=" + paramosPriemones + "&" + tipas + "=" + duom + "&width=" + w + "&height=" + h;
}

function getAktyviasParamosPriemones(inArray){
    var els = [ ];
    $('#prognozes > .active').each(function () {
        els.push(parseInt($(this).attr("id")));
    });
    if(inArray == true){
        return els;
    }
    var joinedElems = els.join(",");
    return joinedElems;
}

function getAktyvusPadaliniai(inArray){
    var pad = [ ];
    $("#Pad > .rodyti").each(function () {
        pad.push(parseInt($(this).attr("id")));
    });
    if(inArray == true){
        return pad;
    }
    var joinedPadaliniai = pad.join(",");
    return joinedPadaliniai;
}

function getAktyviosIs(inArray){
    var is = [ ];
    $("#Is > .rodyti").each(function () {
        is.push(parseInt($(this).attr("id")));
    });
    if(inArray == true){
        return is;
    }
    var joinedIs = is.join(",");
    return joinedIs;
}

function zoomIn(chartType){
    var diagrama = "";
    var chart = "";
    var paramPriem = getAktyviasParamosPriemones(false);
    var img = "";
    var data = "";
    var w = 0;
    var h = 0;
    if(chartType == "padalinys"){
        img = document.getElementById("chart1");
        diagrama = "padaliniu_prognoze";
        chart = "chart1";
        img1_width += 137;
        img1_height += 50;
        data = getAktyvusPadaliniai(false);
        w = img1_width;
        h = img1_height;
    }else{
        img = document.getElementById("chart2");
        diagrama = "is_prognoze";
        chart = "chart2";
        img2_width += 137;
        img2_height += 50;
        data = getAktyviosIs(false);
        w = img2_width;
        h = img2_height;
    }
    img.width = w;
    img.height = h;
    setImage(diagrama, chart, paramPriem, data, w, h);
}

function zoomOut(chartType){
    var diagrama = "";
    var chart = "";
    var img = "";
    var paramPriem = getAktyviasParamosPriemones(false);
    var data = "";
    var w = 0;
    var h = 0;
    if(chartType == "padalinys"){
        img = document.getElementById("chart1");
        diagrama = "padaliniu_prognoze";
        chart = "chart1";
        img1_width -= 137;
        img1_height -= 50;
        data = getAktyvusPadaliniai(false);
        w = img1_width;
        h = img1_height;
    }else{
        img = document.getElementById("chart2");
        diagrama = "is_prognoze";
        chart = "chart2";
        img2_width -= 137;
        img2_height -= 50;
        data = getAktyviosIs(false);
        w = img2_width;
        h = img2_height;
    }
    img.width = w;
    img.height = h;
    setImage(diagrama, chart, paramPriem, data, w, h);
}





(function () {
    $(document).ready(ready);
})();

function ready() {
    
    $(".dropDownMenu").live("mouseover", function(){
        $(this).css("position", "absolute");
        var kids = $(this).children();
        $(kids[1]).css("display", "block");
    });
    
    $(".dropDownMenu").live("mouseout", function(){
        var kids = $(this).children();
        $(kids[1]).css("display", "none");
        $(this).css("position", "static");
    });
    
    $(".dropDownButtons > li").click(function(){
        var text = $(this).text();
        var dropbox = $(this).parent().parent();
        var kids = $(dropbox).children();
        var tipas = $(dropbox).attr("tipas");
        var id = $(this).attr("objectid");
        $(kids[0]).text(text);
        $(kids[1]).css("display", "none");
        $(dropbox).css("position", "static");
        $("#messageTvarkymui").html("Prašome palaukti...");
        $.ajax({
            url: "AjaxActions/User/PadaliniuIrIsTavarkymas.php?tipas=" + tipas + "&id=" + id,
            success: function(data){
                $("#messageTvarkymui").html(data);
            }
        });
    });
    
    $("#menu a").live("mouseenter", function(){
        var hintas = $(this).attr("hintas");
        $("#hint").text(hintas);
    });
    
    $("#ImporterForm").submit(function(){
        this.target = "uploadTarget";
    });
   
    // User delete
    $("span.delUser").click(function(){
        if(confirm("Ar tikrai norite ištrinti?")){
            var id = $(this).attr("userid");
            var elem = this;

            $.ajax({
                url: "AjaxActions/Admin/DeleteUser.php?id=" + id,
                success: function(data){
                    var mas = data.split(":::", 2);
                    if(mas[0] == "true"){
                        $(elem).parent().parent().remove();
                    }else{
                        var kids = $(elem).parent().parent().children();
                        var text = $(kids[0]).text();
                        $(kids[0]).text(text + " " + mas[1])
                    }
                }
            });
        }
    });
    
    // Paspaudus ant paramos priemones
    $('#prognozes > li').click(function () {
       $(this).toggleClass("active"); 
    });
    
    // Paspaudus ant paramos priemones
    $('#prognozes > li').click(function () {
        var img1 = document.getElementById("chart1");
        var img2 = document.getElementById("chart2");
        var joinedElem = getAktyviasParamosPriemones(false);
        var els = getAktyviasParamosPriemones(true);
        
        img1_width = 548;
        img1_height = 200;
        img1.width = img1_width;
        img1.height = img1_height;
        
        img1_width = 548;
        img1_height = 200;
        img2.width = img2_width;
        img2.height = img2_height;
        
        if(els.length > 0){
            if($("#PadZooms").children().length == 0){
                $("#PadZooms").append($("<span/>").text("Zoom in").click(function(){
                    zoomIn("padalinys");
                }));
                $("#PadZooms").append($("<span/>").text("Zoom out").click(function(){
                    if(img1_width != 548){
                        zoomOut("padalinys");
                    }
                }));
            }
            if($("#IsZooms").children().length == 0){
                $("#IsZooms").append($("<span/>").text("Zoom in").click(function(){
                    zoomIn("is");
                }));
                $("#IsZooms").append($("<span/>").text("Zoom out").click(function(){
                    if(img2_width != 548){
                        zoomOut("is");
                    }
                }));
            }
        }else{
            $("#IsZooms").empty();
            $("#PadZooms").empty();
        }
       
        $.ajax({
            url: "AjaxActions/User/PrognoziuLenteles.php?param=" + joinedElem,
            success: function(data){
                $("#ProgTable").html(data);
            }
        });
        
        $.ajax({
            url: "AjaxActions/User/ParamuPadaliniai.php?param=" + joinedElem,
            success: function(data){
                $("#PadButtons").html(data);
            }
        });
        
        $.ajax({
            url: "AjaxActions/User/ParamuIs.php?param=" + joinedElem,
            success: function(data){
                $("#IsButtons").html(data);
            }
        });
        
        setImage("padaliniu_prognoze", "chart1", joinedElem, "all", null, null);
        setImage("is_prognoze", "chart2", joinedElem, "all", null, null);
    });
    
    // Paspaudus enter ant laukeliu duomenu analizei
    $('#data').live("keydown", function (event) {
        if (event.keyCode == 13)
            analizeapmps();
    });
    
    // Paspaudus ant padalinio
    $("#Pad > span").live("click", function(){
        $(this).toggleClass("active");
        $(this).toggleClass("rodyti");
        var joinedElem = getAktyviasParamosPriemones(false);
        var joinedPadaliniai = getAktyvusPadaliniai(false);
        
        setImage("padaliniu_prognoze", "chart1", joinedElem, joinedPadaliniai, null, null);
    });
    
    $("#Is > span").live("click", function(){
        $(this).toggleClass("active");
        $(this).toggleClass("rodyti");
        var joinedElem = getAktyviasParamosPriemones(false);
        var joinedIs = getAktyviosIs(false);
        
        setImage("is_prognoze", "chart2", joinedElem, joinedIs, null, null);
    });
    
    $("td.tdPav").live("mouseenter", function(){
        var pavadinimas = $(this).attr("pavadinimas");
        $(this).css("background-color", "#CA4C44");
        $(this).css("color", "white");
        $(this).parent().after("<tr id='priemoneEmpty'><td colspan='13' style='background-color:#CA4C44; color:white;'>" + pavadinimas + "</td></tr>");
    });
    
    $("td.tdPav").live("mouseout", function(){
        $(this).css("background-color", "white");
        $(this).css("color", "red");
        $("#priemoneEmpty").remove();
    });
    
}