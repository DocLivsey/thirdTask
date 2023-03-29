window.addEventListener('DOMContentLoaded', function(event){
    let user_bio_area = document.getElementById("user-bio");
    user_bio_area.addEventListener("change", function(event){
        let user_bio_col = user_bio_area.style.columnCount;
    });
    let user_gender = document.getElementsByTagName("user_gender");
    user_gender.forEach(function(radio){
        radio.addEventListener("change", function(event) {
            let theme = document.getElementById("user-form");
          });
    })
});