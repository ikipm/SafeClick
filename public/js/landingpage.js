document.addEventListener("DOMContentLoaded", function() {
  var lang = window.location.href.split('/')[3];
  const textsCat = ["Aprèn", "Comprèn", "Protegeix-te"];
  const textsEs = ["Aprende", "Comprende", "Protegete"];
  const textsEn = ["Learn", "Understand", "Secure you"];
  let currentTextIndex = 0;
  const typedTextElement = document.getElementById("typed-text");

  function typeNextText() {
    if (lang == ""){
      var currentText = textsCat[currentTextIndex];
    } else if (lang == "es") {
      var currentText = textsEs[currentTextIndex];
    } else if (lang == "en") {
      var currentText = textsEn[currentTextIndex];
    } else {
      var currentText = textsCat[currentTextIndex];
    }
    let currentCharacterIndex = 0;
    const typingInterval = setInterval(() => {
      typedTextElement.textContent = currentText.slice(0, currentCharacterIndex);
      currentCharacterIndex++;
      if (currentCharacterIndex > currentText.length) {
        clearInterval(typingInterval);
        setTimeout(eraseText, 2000);
      }
    }, 100);

    currentTextIndex = (currentTextIndex + 1) % currentText.length;
  }

  function eraseText() {
    let currentCharacterIndex = typedTextElement.textContent.length;
    const erasingInterval = setInterval(() => {
      typedTextElement.textContent = typedTextElement.textContent.slice(0, currentCharacterIndex);
      currentCharacterIndex--;
      if (currentCharacterIndex < 0) {
        clearInterval(erasingInterval);
        setTimeout(typeNextText, 1000);
      }
    }, 50);
  }

  typeNextText();
});

// Language menu
document.addEventListener("DOMContentLoaded", function() {
  const currentLanguage = document.querySelector(".current-language");
  const languageList = document.querySelector(".language-list");
  const smallLanguageMenu = document.querySelector(".small-language-menu");

  currentLanguage.addEventListener("click", function() {
    languageList.classList.toggle("show");
    smallLanguageMenu.classList.toggle("show");
  });

  currentLanguage.addEventListener("blur", function() {
    languageList.classList.remove("show");
    smallLanguageMenu.classList.remove("show");
  });
});


