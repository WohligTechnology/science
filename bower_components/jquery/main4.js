/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function () {

    var bodyEl = document.body,
        content = document.querySelector('.content-wrap'),
        openbtn = document.getElementById('open-button'),
        openbtns = document.getElementById('.open-button'),
        openbtn2 = document.getElementById('open-button2'),
        openbtn3 = document.getElementById('open-button3'),
        openbtn4 = document.getElementById('open-button4'),
        openbtn5 = document.getElementById('open-button5'),
        openbtn6 = document.getElementById('open-button6'),
        openbtn7 = document.getElementById('open-button7'),
        openbtn8 = document.getElementById('open-button8'),
        closebtn = document.getElementById('close-button'),
        closebtn2 = document.getElementById('close-button2'),
        closebtn3 = document.getElementById('close-button3'),
        closebtn4 = document.getElementById('close-button4'),
        closebtn5 = document.getElementById('close-button5'),
        closebtn6 = document.getElementById('close-button6'),
        closebtn7 = document.getElementById('close-button7'),
        closebtn8 = document.getElementById('close-button8'),
        isOpen = false;

    function init() {
        initEvents();
    }

    function initEvents() {
        openbtn.addEventListener('click', toggleMenu);
        openbtn2.addEventListener('click', toggleMenu);
        openbtn3.addEventListener('click', toggleMenu);
        openbtn4.addEventListener('click', toggleMenu);
        openbtn5.addEventListener('click', toggleMenu);
        openbtn6.addEventListener('click', toggleMenu);
        openbtn7.addEventListener('click', toggleMenu);
        openbtn8.addEventListener('click', toggleMenu);
        if (closebtn) {
            closebtn.addEventListener('click', toggleMenu);
            closebtn2.addEventListener('click', toggleMenu);
            closebtn3.addEventListener('click', toggleMenu);
            closebtn4.addEventListener('click', toggleMenu);
            closebtn5.addEventListener('click', toggleMenu);
            closebtn6.addEventListener('click', toggleMenu);
            closebtn7.addEventListener('click', toggleMenu);
            closebtn8.addEventListener('click', toggleMenu);
        }

        // close the menu element if the target it´s not the menu element or one of its descendants..
        content.addEventListener('click', function (ev) {
            var target = ev.target;
            if (isOpen && target !== openbtn) {
                toggleMenu();
            }
        });
    }

    function toggleMenu() {
        if (isOpen) {
            classie.remove(bodyEl, 'show-menu');
        } else {
            classie.add(bodyEl, 'show-menu');
        }
        isOpen = !isOpen;
    }

    init();

})();
