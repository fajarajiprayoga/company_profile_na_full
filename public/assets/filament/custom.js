//Bug width of dropdown profile has class => max-w-[14rem] di production jadi !max-w-[14rem]
var btn_dropwodn_profile = document.querySelectorAll('.fi-dropdown-panel.absolute.z-10.w-screen.divide-y.divide-gray-100.rounded-lg.bg-white.shadow-lg');
var array_of_btn_dropdown_profile = Array.from(btn_dropwodn_profile);
array_of_btn_dropdown_profile.forEach(element => {
element.classList.remove('max-w-[14rem]');
element.style.width = '14rem';
});

function callback(mutationsList, observer) {
    for (let mutation of mutationsList) {
        if (mutation.type === 'childList') {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === Node.ELEMENT_NODE) {
                    if (node.nodeType === Node.ELEMENT_NODE && node.hasAttribute('x-ref') && node.getAttribute('x-ref') === 'modalContainer') {
                        console.log('Elemen baru ditemukan:', node);
                        node.classList.remove('min-h-full');
                        node.style.height = '230px';
                    }
                }
            });
        }
    }
}

const observer = new MutationObserver(callback);
const config = {
    childList: true,
    subtree: true
};
const targetNode = document.body;
observer.observe(targetNode, config);
