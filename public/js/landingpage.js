document.addEventListener("DOMContentLoaded", function () {
    const texts = {
        "": ["Aprèn", "Comprèn", "Protegeix-te"], // Català
        es: ["Aprende", "Comprende", "Protegete"], // Castellà
        en: ["Learn", "Understand", "Secure you"], // Anglès
    };
    let currentTextIndex = 0;
    const typedTextElement = document.getElementById("typed-text");
    const currentList = texts[currentLocale] || texts[""];

    function typeNextText() {
        const currentText = currentList[currentTextIndex];
        let currentCharacterIndex = 0;
        const typingInterval = setInterval(() => {
            typedTextElement.textContent = currentText.slice(
                0,
                currentCharacterIndex
            );
            currentCharacterIndex++;
            if (currentCharacterIndex > currentText.length) {
                clearInterval(typingInterval);
                setTimeout(eraseText, 2000);
            }
        }, 100);

        currentTextIndex = (currentTextIndex + 1) % currentList.length;
    }

    function eraseText() {
        let currentCharacterIndex = typedTextElement.textContent.length;
        const erasingInterval = setInterval(() => {
            typedTextElement.textContent = typedTextElement.textContent.slice(
                0,
                currentCharacterIndex
            );
            currentCharacterIndex--;
            if (currentCharacterIndex < 0) {
                clearInterval(erasingInterval);
                setTimeout(typeNextText, 1000);
            }
        }, 50);
    }

    typeNextText();
});
