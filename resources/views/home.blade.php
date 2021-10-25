@extends('layouts.main')

@section('title', 'YouTube API')

@section('content')
@include('layouts/navbar')

<div class="body" id="body">
    <form autocomplete="off" id="yt-form-search">
        @csrf
        <div class="field has-addons">
            <div class="control is-expanded">
                <input name="q" class="input" type="text" placeholder="Digite um termo de busca">
            </div>
            <div class="control">
                <button class="button is-link" type="submit">
                    Pesquisar
                </button>
            </div>
        </div>
        <div class="nresFieldBox">
            <div class="field has-addons">
                <p class="control">
                    <a class="button is-static">
                        Resultados máximos
                    </a>
                </p>
                <p class="control nresField">
                    <input class="input" name="n" type="number" value="6" min="5" max="50">
                </p>
            </div>
        </div>
    </form>
    <div class="body yt-results has-text-centered" id="yt-results">
        
    </div>
</div>

<div id="modal1" class="modal">
    <div class="modal-content" id="modal1_content">
    </div>
</div>

<script>
var spinner_html = '<img class="preloadergif" src="@php echo url('') @endphp/89.gif" />';
document.querySelector("#yt-form-search").addEventListener("submit",async function(e) {
    e.preventDefault();
    document.querySelector("#yt-results").innerHTML = spinner_html;
    result = await fetch('@php echo url('/') @endphp/youtube/search', {
        method: 'POST',
        body: new URLSearchParams(new FormData(document.querySelector("#yt-form-search")))
    }).then(function(response) {
        return response.text();
    });
    document.querySelector("#yt-results").innerHTML = result;
});
function showVideo(id) {
    modal = document.querySelector("#modal1");
    modal_content = document.querySelector("#modal1_content");
    modal_content.innerHTML = '<center><iframe width="560" height="315" src="https://www.youtube.com/embed/' + id + '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>';
    modal_content.classList.add("animate-fade-in");
    modal.style.display = "block";
    
    window.onclick = function(event) {
        if (event.target == modal) {
            modal_content.innerHTML = '';
            modal.style.display = "none";
        }
    }
}

async function showPageHistorico() {
    document.querySelector("#body").innerHTML = '<center>' + spinner_html + '</center>';
    result = await fetch('@php echo url('/') @endphp/myhistory', {
        method: 'GET'
    }).then(function(response) {
        return response.text();
    });
    document.querySelector("#body").innerHTML = result;
}
</script>
@endsection