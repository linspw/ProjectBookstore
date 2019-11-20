const buyProduct = () => {
    
}
const getHome = () => {
    const generateCards = (dataJSON) => {
        dataJSON.map((e, i)=>{
            let temporalString = "<div class='row'><div class='col s12 m7'><div class='card'><div class='card-content'><p><h5>"+e.name+"<h5></p><p><h6>"+e.description+"</h6></p></div><div class='card-action'><a href='#'>This is a link</a></div></div></div></div>"
            $('#main-content').append(temporalString)
        })
    }
    $.ajax({
        url: 'http://127.0.0.1/ProjectBookStore/api/controller/Products/listProducts.php',
        method: 'GET',
        contentType:"text/html",
        dataType: 'json',
        success: (push)=>{
            console.log(push)
            $('#main-content').html("")
            generateCards(push)
            //$('#main-content').html(push)
        }, error: (e) => {
            console.log("Error", e)
        },
    });
}

$('document').ready(()=>{
    getHome()
    $(document).on("click","#btn-home", ()=> {
        getHome()
    });
})