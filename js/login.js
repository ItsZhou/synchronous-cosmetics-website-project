/*window.addEventListener("load", function( event ) {
let node;
node = document.querySelector( ".iniciosesion" );
node.addEventListener( "click", iniciarSesion );//defines el click y despues pones que funcion quieres que se ejecute
});*/

window.addEventListener("load", load);

function load() {
    let node;
    node = document.querySelector( ".iniciosesion" );
    node.addEventListener( "click", iniciarSesion );

    node = document.querySelector( ".login" );
    node.addEventListener( "click", hiddenLogin);
}

function iniciarSesion() {
    let node;
    node = document.querySelector( ".login" );
    node.classList.remove( "hiddenD" );
    node = document.querySelector( ".iniciosesion" );
    node.classList.add( "hiddenD" );
}

function hiddenLogin( event ) {
    if ( event.target === this ) { //event.target hace referencia al login y this tambien, entonces si es igual se ejecuta la funcion
    let node;						//y si no es igual, no se ejecuta.
    node = document.querySelector( ".login" );
    node.classList.add( "hiddenD" );
    node = document.querySelector( ".iniciosesion" );
    node.classList.remove( "hiddenD" );
    }
}

function validateloginform() {
    let isValidate = true;
    const reLargo = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/

    loginform.email.className		= "";
    loginform.password.className	= "";

    let email = loginform.email.value;
    let password = loginform.password.value;
    
    if ( email.trim() === "" ) {
        loginform.email.className = "error";
        isValidate = false;
    } else if ( !reLargo.test( email ) ) {
        loginform.email.className = "error";           
        isValidate = false;
    }
    if ( password.length < 8 ) {
        loginform.email.className = "error";
        isValidate = false;
    }
    return isValidate;
}