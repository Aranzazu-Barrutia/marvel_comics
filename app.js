// Constants
const PUBLIC_KEY = '65d925b1746ea75fc71f7a076fd3bb43';
const PRIVATE_KEY = '0967a8e1d5934246a4fc561261ea5d5bd4a1a0c5';
const BASE_URL = 'http://gateway.marvel.com/v1/public/';

// Funciones para realizar las solicitudes a la API de Marvel

async function fetchComics() {
  const timestamp = new Date().getTime().toString();
  const hash = CryptoJS.MD5(timestamp + PRIVATE_KEY + PUBLIC_KEY).toString();
  const url = `${BASE_URL}comics?apikey=${PUBLIC_KEY}&ts=${timestamp}&hash=${hash}`;

  const response = await fetch(url);
  const data = await response.json();

  return data.data.results;
}

async function fetchSeries() {
  const timestamp = new Date().getTime().toString();
  const hash = CryptoJS.MD5(timestamp + PRIVATE_KEY + PUBLIC_KEY).toString();
  const url = `${BASE_URL}series?apikey=${PUBLIC_KEY}&ts=${timestamp}&hash=${hash}`;

  const response = await fetch(url);
  const data = await response.json();

  return data.data.results;
}

// Funciones para mostrar los resultados en la interfaz de usuario

function displayComics(comicsData) {
  const comicsList = document.getElementById('comicsList');
  comicsList.innerHTML = ''; // Limpiar la lista antes de agregar nuevos elementos

  comicsData.forEach((comic) => {
    const comicItem = createListItem(comic);
    comicsList.appendChild(comicItem);
  });
}

function displaySeries(seriesData) {
  const seriesList = document.getElementById('seriesList');
  seriesList.innerHTML = ''; // Limpiar la lista antes de agregar nuevos elementos

  seriesData.forEach((series) => {
    const seriesItem = createListItem(series);
    seriesList.appendChild(seriesItem);
  });
}

// Función para crear un elemento de lista con imagen y título
function createListItem(item) {
  const listItem = document.createElement('li');
  listItem.textContent = item.title;

  // Agregar la imagen si está disponible
  if (item.thumbnail && item.thumbnail.path && item.thumbnail.extension) {
    const img = document.createElement('img');
    img.src = `${item.thumbnail.path}.${item.thumbnail.extension}`;
    listItem.appendChild(img);
  }

  // Agregar el evento de clic para mostrar la ventana modal
  listItem.addEventListener('click', () => showModal(item));

  return listItem;
}

// Lógica principal de la aplicación

document.addEventListener('DOMContentLoaded', async function () {
  try {
    await new Promise((resolve) => setTimeout(resolve, 100));
    // Realiza las solicitudes a la API de Marvel
    const comicsData = await fetchComics();
    const seriesData = await fetchSeries();

    // Muestra los resultados en la interfaz de usuario
    displayComics(comicsData);
    displaySeries(seriesData);

    // Función para ordenar alfabéticamente los elementos de una lista
    function sortListAlphabetically(listId) {
      const list = document.getElementById(listId);
      const items = Array.from(list.children);

      items.sort((a, b) => {
        const textA = a.textContent.trim().toLowerCase();
        const textB = b.textContent.trim().toLowerCase();
        return textA.localeCompare(textB);
      });

      items.forEach((item) => list.appendChild(item));
    }

    // Llamadas a la función para ordenar alfabéticamente cada lista
    sortListAlphabetically('comicsList');
    sortListAlphabetically('seriesList');

    // Inicializar carrusel para cada sección
    initializeCarousel('comicsList');
    initializeCarousel('seriesList');
  } catch (error) {
    console.error('Error en la aplicación:', error);
  }
});

function initializeCarousel(listId) {
  $(`#${listId}`).slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: `<button type="button" class="slick-prev">Previous</button>`,
    nextArrow: `<button type="button" class="slick-next">Next</button>`,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
}

// Función para mostrar la ventana modal con la información del cómic o serie seleccionado
function showModal(selectedItem) {
  const modalContent = document.getElementById('modalContent');

  // Llenar la ventana modal con la información del cómic o serie
  modalContent.innerHTML = `
    <h2>${selectedItem.title}</h2>
    <p>${selectedItem.description}</p>
    <img src="${selectedItem.thumbnail.path}.${selectedItem.thumbnail.extension}" alt="${selectedItem.title}">
  `;

  // Mostrar la ventana modal
  $('#modal').modal('show');
  // Agregar evento de clic para cerrar la ventana modal al hacer clic en el botón de cierre
  const closeButton = document.querySelector('.close');
  closeButton.addEventListener('click', () => {
    $('#modal').modal('hide');
  });
}

// Función para filtrar los cómics y series según el término de búsqueda
function filterComicsAndSeries(searchTerm) {
  const comicsList = document.getElementById('comicsList');
  const seriesList = document.getElementById('seriesList');
  const comics = Array.from(comicsList.children);
  const series = Array.from(seriesList.children);

  // Filtrar los cómics y series que coinciden con el término de búsqueda
  const filteredComics = comics.filter((comic) =>
    comic.textContent.trim().toLowerCase().includes(searchTerm.toLowerCase())
  );
  const filteredSeries = series.filter((serie) =>
    serie.textContent.trim().toLowerCase().includes(searchTerm.toLowerCase())
  );

  // Mostrar solo los cómics y series filtrados
  displayFilteredResults(filteredComics, filteredSeries);
}

// Función para mostrar solo los cómics y series filtrados
function displayFilteredResults(filteredComics, filteredSeries) {
  const comicsList = document.getElementById('comicsList');
  const seriesList = document.getElementById('seriesList');

  // Limpiar las listas antes de agregar los resultados filtrados
  comicsList.innerHTML = '';
  seriesList.innerHTML = '';

  // Agregar los cómics filtrados a la lista de cómics
  filteredComics.forEach((comic) => {
    comicsList.appendChild(comic);
  });

  // Agregar las series filtradas a la lista de series
  filteredSeries.forEach((serie) => {
    seriesList.appendChild(serie);
  });

  // Re-inicializar el carrusel para cada sección después de la actualización
  initializeCarousel('comicsList');
  initializeCarousel('seriesList');
}
