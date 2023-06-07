var search = document.getElementById('pesquisar');
function searchData()
{
    window.location = 'painel_adm.php?search='+search.value;
}