function preloadPic(e, target_id) {
    var reader = new FileReader();
    reader.onload = function (e) {
        var p = e.target.result;
        document.getElementById(target_id).src = p;
    };

    reader.readAsDataURL(e.target.files[0]); //trigger?
};