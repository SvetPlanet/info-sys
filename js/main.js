$(document).ready(function(){
 $.ajax({ 
   url: "tree.php",
   method:"POST",
   dataType: "json",       
   success: function(data)  
     {
         $('#treeview').treeview({data: data, onhoverColor: '#70AE6E', selectedBackColor: '#70AE6E'});
     }   
 });
});

function sendajax()
{
    $.post('session.php', {}, function(response) {
        console.log(response);
    });
}

$(window).on('load',function(){
    $('#modalRes').modal('show');
});

function show(elem){
    var hide = document.getElementsByClassName("adding");

    for(var i = 0; i < hide.length; i++){
        hide[i].style.display = "none";
    }

    var a = elem.value;
    switch (a) {
        case "1":
            document.getElementById('test').style.display = "block";
            break;
        case "2":
            document.getElementById('organization').style.display = "block";
            break;
        case "3":
            document.getElementById('worker').style.display = "block"
            break;
        case "4":
            document.getElementById('object').style.display = "block"
            break;
        case "5":
            document.getElementById('equipment').style.display = "block"
            break;
        case "6":
            document.getElementById('standards').style.display = "block"
            break;
        case "7":
            document.getElementById('methods_cats').style.display = "block"
            break;
        default:
            alert( 'Я таких значений не знаю' );
    }
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
}) 

function calc() 
{
    var x = document.getElementById("price_form");
    var check = true;
    var tmp = 0;
    var st = 0;
    if (document.getElementById("from_separate") != null)
    {
        tmp = 7;
        st = 2;
    }
    else
    {
        tmp = 6;
    }
    
    var a = new Array();
    var n = x.length - tmp;
    for (var i = st; i < n; i++) 
    {
        if ((x.elements[i].value == null) || (x.elements[i].value == ""))
        {
            check = false;
        }
        else
        {
            a[i] = parseFloat(x.elements[i].value);
        }
    }
    
    if (check == true)
    {
        
        var L = a[0+st];
        var Knz = a[1+st];
        var Knr = a[2+st];
        var P = a[3+st];
        var tp = a[4+st];
        var tpp = a[5+st];
        var tap = a[6+st];
        var tpz = a[7+st];
        var tio = a[8+st];
        var Kio = a[9+st];
        var tm = a[10+st];
        var m = a[11+st];
        var Km = a[12+st];
        var Klo = a[13+st]

        var tmo = (Km + 1) * m * tm;
        var tir = tio * (1 + Kio);
        var ti = tp + tpp + tap + tpz + tir + tmo;
        var num = ti * L * (1 + (Knz + Knr)/100) * (1 + (P/100)) * Klo;
        var Cip = Math.round(num * 100) / 100;
        document.getElementById("price_input").value = Cip;
    }
    else 
    {
        alert("Невозможно выполнить расчет. Не все данные введены!");    
    }
}

function clean()
{
    var x = document.getElementById("price_form");
    var st = 0;
    if (document.getElementById("from_separate") != null)
    {
        st = 2;
    }
    x.elements[2+st].value = "";
    x.elements[3+st].value = "";
    x.elements[5+st].value = "";
    x.elements[7+st].value = "";
    x.elements[8+st].value = "";
    x.elements[13+st].value = "";
}

function cleanAll()
{
    var x = document.getElementById("price_form");
    var n = x.length - 6;

    for (var i = 0; i < n; i++) 
    {
        x.elements[i].value = "";
    }
}

function isemp()
{
    if (document.getElementById("price_input").value == "")
    {
        alert("Невозможно сохранить расчет. Не все данные введены!");
        return false;
    }
}

$(function () {
    $('#datetimepicker1').datetimepicker();
});