const API_KEY = 'api_key=1cf50e6248dc270629e802686245c2c8';
const BASE_URL = 'https://api.themoviedb.org/3';
const API_URL = BASE_URL + '/discover/movie?sort_by=popularity.desc&'+API_KEY;
const IMG_URL = 'https://image.tmdb.org/t/p/w500';
const searchURL = BASE_URL + '/search/movie?'+API_KEY;
const film_det = BASE_URL + '/movie/';

/* ------------ recuperer l'id dans l'url (quent) ------------ */

var url = window.location.search;
var id = url.substring(url.lastIndexOf('=') + 1);
/*console.log(id);*/

/* ------------ fetch avc api (quent) ------------ */

fetch(film_det + id + '?' + API_KEY)
.then(response => response.json())
.then(data => {
    setupMovieInfo(data);
})

const setupMovieInfo = (data) => {
    const movieName = document.querySelector('.movie-name');
    const genres = document.querySelector('.genres');
    const des = document.querySelector('.des');
    const title = document.querySelector('title');
    const backdrop = document.querySelector('.movie-info');

    title.innerHTML = movieName.innerHTML = data.title; 
    genres.innerHTML = `${data.release_date.split('-')[0]} | `;
    for(let i = 0; i < data.genres.length; i++){
        genres.innerHTML += data.genres[i].name + formatString(i, data.genres.length);
    }

    if(data.adult == true){
        genres.innerHTML += ' | +18';
    }

    if(data.backdrop_path == null){
        data.backdrop_path = data.poster_path;
    }

    des.innerHTML = data.overview.substring(0, 200) + '...';

    backdrop.style.backgroundImage = `url('${IMG_URL}${data.backdrop_path}')`;
}

const formatString = (currentIndex, maxIndex) => {
    return (currentIndex == maxIndex - 1) ? '' : ', ';
}

//fetching cast info

fetch(film_det + id + '/credits?' + API_KEY) 
.then(res => res.json())
.then(data => {
    const cast = document.querySelector('.starring');
    for(let i = 0; i < 5; i++){
        cast.innerHTML += data.cast[i].name + formatString(i, 5);
    }
})

// fetching video clips

fetch(film_det + id + '/videos?' + API_KEY)
.then(res => res.json())
.then(data => {
    let trailerContainer = document.querySelector('.trailer-container');

    let maxClips = (data.results.length > 4) ? 4 : data.results.length;

    for(let i = 0; i < maxClips; i++){
        trailerContainer.innerHTML += `
        <iframe src="https://youtube.com/embed/${data.results[i].key}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        `;
    }
})

