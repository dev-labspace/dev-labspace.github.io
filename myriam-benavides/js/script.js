document.addEventListener("DOMContentLoaded", () => {
  const revealElements = document.querySelectorAll(".reveal");
  const contactForm = document.getElementById("contactForm");
  const formMessage = document.getElementById("formMessage");
  const navLinks = document.querySelectorAll(".nav-link");
  const navbarCollapse = document.getElementById("mainNav");
  const langButtons = document.querySelectorAll(".lang-btn");
  const formLanguage = document.getElementById("formLanguage");
  const startedAt = document.getElementById("formStartedAt");

  let currentLang = localStorage.getItem("siteLang") || "es";

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    },
    { threshold: 0.14 }
  );

  revealElements.forEach((el) => observer.observe(el));

  function applyLanguage(lang) {
    const dictionary = window.translations?.[lang];

    if (!dictionary) return;

    currentLang = lang;
    document.documentElement.lang = lang;
    localStorage.setItem("siteLang", lang);

    if (formLanguage) {
      formLanguage.value = lang;
    }

    document.querySelectorAll("[data-i18n]").forEach((element) => {
      const key = element.dataset.i18n;

      if (dictionary[key]) {
        element.textContent = dictionary[key];
      }
    });

    document.querySelectorAll("[data-i18n-placeholder]").forEach((element) => {
      const key = element.dataset.i18nPlaceholder;

      if (dictionary[key]) {
        element.placeholder = dictionary[key];
      }
    });

    langButtons.forEach((button) => {
      button.classList.toggle("active", button.dataset.lang === lang);
    });
  }

  langButtons.forEach((button) => {
    button.addEventListener("click", () => {
      applyLanguage(button.dataset.lang);
    });
  });

  applyLanguage(currentLang);

  navLinks.forEach((link) => {
    link.addEventListener("click", () => {
      if (
        window.innerWidth < 992 &&
        navbarCollapse &&
        navbarCollapse.classList.contains("show")
      ) {
        const bsCollapse =
          bootstrap.Collapse.getInstance(navbarCollapse) ||
          new bootstrap.Collapse(navbarCollapse, { toggle: false });

        bsCollapse.hide();
      }
    });
  });

  if (startedAt) {
    startedAt.value = Date.now().toString();
  }

  if (contactForm) {
    contactForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      const dictionary = window.translations?.[currentLang] || window.translations.es;
      const submitButton = contactForm.querySelector('button[type="submit"]');
      const formData = new FormData(contactForm);

      formMessage.textContent = "";
      submitButton.disabled = true;
      submitButton.textContent = dictionary.form_sending;

      try {
        const response = await fetch(contactForm.action, {
          method: "POST",
          body: formData,
        });

        const text = await response.text();
        let result;

        try {
          result = JSON.parse(text);
        } catch (error) {
          throw new Error("Respuesta no JSON: " + text);
        }

        formMessage.textContent = result.message;
        formMessage.style.color = result.success ? "#2f6f4e" : "#9b2c2c";

        if (result.success) {
          contactForm.reset();

          if (formLanguage) {
            formLanguage.value = currentLang;
          }

          if (startedAt) {
            startedAt.value = Date.now().toString();
          }
        }
      } catch (error) {
        formMessage.textContent = dictionary.form_connection_error;
        formMessage.style.color = "#9b2c2c";
      } finally {
        submitButton.disabled = false;
        submitButton.textContent = dictionary.form_submit;
      }
    });
  }
});