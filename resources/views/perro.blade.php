<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Galería de Perros Aleatorios</title>
  <link rel="stylesheet" href="{{ asset('css/style-perros.css') }}"/>
</head>
<body>
  <div class="container">
    <h1>🐶 Galería de Perros Aleatorios</h1>

    <div class="custom-select-wrapper">
      <input type="text" id="breedInput" placeholder="Escribe una raza..." autocomplete="off" />
      <ul id="suggestions" class="suggestions hidden"></ul>
    </div>

    <button onclick="getDogImage()">Mostrar imagen</button>

    <div>

      <img id="dogImage" src="" alt="" style="display: none;" />
    </div>
  </div>

  <script>
    const img = document.getElementById("dogImage");
    const breedInput = document.getElementById("breedInput");
    const suggestions = document.getElementById("suggestions");
    let allOptions = [];
    let selectedBreedValue = "";

    function getDogImage() {
      let url = "https://dog.ceo/api/breeds/image/random";

      if (selectedBreedValue) {
        url = `https://dog.ceo/api/breed/${selectedBreedValue}/images/random`;
      }

      fetch(url)
        .then(res => res.json())
        .then(data => {
          img.src = data.message;
          img.style.display = "block";
        })
        .catch(err => alert("Error al obtener la imagen: " + err));
    }

    fetch("https://dog.ceo/api/breeds/list/all")
      .then(res => res.json())
      .then(data => {
        const breeds = data.message;

        for (let breed in breeds) {
          if (breeds[breed].length > 0) {
            breeds[breed].forEach(sub => {
              allOptions.push({ value: `${breed}/${sub}`, text: `${sub} (${breed})` });
            });
          } else {
            allOptions.push({ value: breed, text: breed });
          }
        }

        allOptions.sort((a, b) => a.text.localeCompare(b.text));
      });

    breedInput.addEventListener("input", () => {
      const search = breedInput.value.toLowerCase();

      const filtered = search === ""
        ? allOptions
        : allOptions.filter(opt =>
            opt.text.toLowerCase().includes(search)
          );

      const match = allOptions.find(opt => opt.text.toLowerCase() === search);
      selectedBreedValue = match ? match.value : "";

      showSuggestions(filtered);
    });

    breedInput.addEventListener("focus", () => {
      showSuggestions(allOptions);
    });

    function showSuggestions(options) {
      suggestions.innerHTML = "";

      if (options.length === 0) {
        suggestions.classList.add("hidden");
        return;
      }

      options.sort((a, b) => a.text.localeCompare(b.text));

      options.slice(0, 8).forEach(opt => {
        const li = document.createElement("li");
        li.textContent = opt.text;
        li.addEventListener("click", () => {
          breedInput.value = opt.text;
          selectedBreedValue = opt.value;
          suggestions.classList.add("hidden");
        });
        suggestions.appendChild(li);
      });

      suggestions.classList.remove("hidden");
    }

    document.addEventListener("click", (e) => {
      if (!e.target.closest(".custom-select-wrapper")) {
        suggestions.classList.add("hidden");
      }
    });
  </script>
</body>
</html>



