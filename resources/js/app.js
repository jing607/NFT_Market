import './bootstrap';

import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import '@fortawesome/fontawesome-free/scss/v4-shims.scss';



document.addEventListener("DOMContentLoaded", function(event) {
    let delBtn = document.querySelectorAll('.del-btn').forEach(el => {
        el.addEventListener('click', function(e){
            e.preventDefault();
            e.stopPropagation();
            console.log(el.getAttribute('href'));
            let conf = confirm('Attention ! Ceci est une action irréversibe. Voulez-vous continuer ?');
            if(conf) {
                document.location.assign(el.getAttribute('href'));
            }

        })
    })


});
