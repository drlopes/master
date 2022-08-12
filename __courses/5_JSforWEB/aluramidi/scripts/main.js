const keys = document.querySelectorAll('.tecla');
const sounds = document.querySelectorAll('audio');

document.onclick = function (event) {
    const index = matchClassToId(event.srcElement.classList[1]);
    try {
        sounds[index].play();
    } catch (e) {
        console.log('click nos botões, cara pálida.');
    }
}

document.onkeydown = function (event) {
    let keyPressed = event.keyCode;
    switch (keyPressed) {
        case 13 || 32:
        for (let i = 0; i < keys.length; i++) {
            if (keys[i].classList[1] ===
                event.srcElement.classList[1]) {
                    keys[i].classList.add('ativa');
                }
        }
        break;
        case 81:
        playFromKeyboard(0);
        break;
        case 87:
        playFromKeyboard(1);
        break;
        case 69:
        playFromKeyboard(2);
        break;
        case 65:
        playFromKeyboard(3);
        break;
        case 83:
        playFromKeyboard(4);
        break;
        case 68:
        playFromKeyboard(5);
        break;
        case 90:
        playFromKeyboard(6);
        break;
        case 88:
        playFromKeyboard(7);
        break;
        case 67:
        playFromKeyboard(8);
        break;
    }
}

document.onkeyup = function (event) {
    for (let i = 0; i < keys.length; i++) {
        keys[i].classList.remove('ativa');
    }
}

function matchClassToId (buttonClass) {
    for (let i = 0; i < sounds.length; i++) {
        const soundId = sounds[i].getAttribute('id');
        if ( buttonClass === soundId ) {
            return i;
        }
    }
}

function playFromKeyboard (keyIndex) {
    keys[keyIndex].classList.add('ativa');
    for (let i = 0; i < sounds.length; i++) {
        if (sounds[i].getAttribute('id') === keys[keyIndex].classList[1]) {
            sounds[i].play();
        }
    }
}
