var timer;

function copySelected(elem, target) {
    var target = document.getElementById(target);
    (elem.preventDefault) ? elem.preventDefault() : elem.returnValue = false;
    if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(target);
        range.select();
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(target);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
    }
    document.execCommand("copy");
    clearTimeout(timer);
    timer = setTimeout(
        function () {
            document.getElementById('sp_copy_status').style.opacity = "0";
        }
        , 2000);
    document.getElementById('sp_copy_status').style.opacity = "1";
    return false;
}