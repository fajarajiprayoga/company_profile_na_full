//Bug width of dropdown profile has class => max-w-[14rem] di production jadi !max-w-[14rem]
var btn_dropwodn_profile = document.querySelectorAll('.fi-dropdown-panel.absolute.z-10.w-screen.divide-y.divide-gray-100.rounded-lg.bg-white.shadow-lg');
var array_of_btn_dropdown_profile = Array.from(btn_dropwodn_profile);
array_of_btn_dropdown_profile.forEach(element => {
element.classList.remove('max-w-[14rem]');
element.style.width = '14rem';
});

//Bug Height of modal form has class => .min-height-full (Membuat height modal terlalu besar)
var modal_container = document.querySelector('[x-ref="modalContainer"]');
var array_modal_container = Array.from(modal_container);
array_modal_container.forEach(element => {
    element.classList.remove('min-h-full');
});

