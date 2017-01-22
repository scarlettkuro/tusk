function preloadPic(e, target_id) {
    var reader = new FileReader();
    reader.onload = function (e) {
        var p = e.target.result;
        document.getElementById(target_id).src = p;
    };

    reader.readAsDataURL(e.target.files[0]);
};


function sort(clas, param) {
    if(!sort.hasOwnProperty("param")) {
        sort.param = '';
    } 
    var reverse = (sort.param === param);
    var atrr = clas + '-' + param;
    
    $("." + clas).sort(function(a, b) {
        var ans = $(a).attr(atrr).toLowerCase() < $(b).attr(atrr).toLowerCase();
        return reverse ? ans : !ans;
    }).each(function() {
        //alert(a[mparam]);
        var elem = $(this);
        elem.remove();
        $(elem).appendTo("#tasks");
    });
    
    sort.param = reverse ? '' : param;
}