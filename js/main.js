// var sl_ap = document.getElementById('sl_ap');

// sl_ap.style.opacity = 0;
// sl_ap.style.visibility = "hidden";

// function showAdminProfile(){
//     sl_ap.style.opacity = 1;
//     sl_ap.style.visibility = "visible";
//     sl_ap.style.transition = "all 0.8s";
// };

// function hideAdminProfile(){
//     sl_ap.style.opacity = 0;
//     sl_ap.style.visibility = "hidden";
//     sl_ap.style.transition = "all 0.8s";
// };

$(function(){
    $('#open_file').click(function(){
        $('#image_file').click();
    });
});

function number_format(number, name = 'Rp ') {
    if (!number || number == "" || number == 0) return "";
    if (name.toLowerCase().indexOf('rp') > -1) {
        if (!isNaN(number)) {
            split = number.toString().split(',');
            number = split[0].toString().split('').reverse().join('')
                .match(/\d{1,3}/g)
                .join('.').split('').reverse().join('');
            number = split[1] != undefined ? number + ',' + split[1] : number;
        }
    }
    return name + ' ' + number;
}