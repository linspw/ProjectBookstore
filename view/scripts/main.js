const buyProduct = (product_id=1) => {
    $.ajax({
        url: 'http://127.0.0.1/ProjectBookStore/api/controller/Stock/buyProducts.php',
        type: "POST",
        data: {product_id: product_id},
        success: (push)=>{
            console.log(push)
            swal(push);
            //$('#main-content').html(push)
        }, error: (e) => {
            console.log("Error", e)
        },
    });
}
const criarProduct = () =>{
    $.ajax({
        url: 'http://127.0.0.1/ProjectBookStore/api/controller/Stock/buyProducts.php',
        type: "POST",
        data: {product_id: product_id},
        success: (push)=>{
            console.log(push)
            swal(push);
            //$('#main-content').html(push)
        }, error: (e) => {
            console.log("Error", e)
        },
    });
}
const getStockPage = () => {
    const generateCards = (dataJSON) => {
        
        dataJSON.map((e, i)=>{
            let temporalString = "<div class='col s12 m7'><div class='card'><div class='card-content'><p><h5>ID_Produto:"+e.COD_PDT+"<h5></p><p><h6>Disponíveis"+e.avaliable_qnt_products	+"</h6></p><p><h6>Vendidas"+e.sold_qnt_products	+"</h6></p><p><h6>Total"+e.total_qnt_products	+"</h6></p></div><div class='card-action'></div></div></div>"
            $('#main-content').append(temporalString)
        })
    }
    $('#main-content').html("")
    $.ajax({
        type: 'post',
        url: 'http://127.0.0.1/ProjectBookStore/api/controller/Stock/listAllStock.php',
        success: function (push) {
            generateCards(push)
            console.log(push)
        }
      });

}
const addProduto = (id, quant=1) => {
    $.ajax({
        url: 'http://127.0.0.1/ProjectBookStore/api/controller/Stock/addProducts.php',
        type: "POST",
        data: {id:id,quant: quant},
        success: (push)=>{
            console.log(push)
            swal(push);
            //$('#main-content').html(push)
        }, error: (e) => {
            console.log("Error", e)
        },
    });
}
const getCriarProductPage = () => {
    $('#main-content').html("<div class='full-screen'><form class='painel'><span><h4>Criar Produto</h4></span><input type='text' name='name' placeholder='Nome' maxlength='30' required/><input type='text' maxlength='30' placeholder='Descrição' name='description' required/><input type='number' placeholder='Preço' maxlength='4' step='0.01' name='value' required/><button class='btn-criar-produto'>Adicionar produto</button></form></div>")
}
const getHome = () => {
    const generateCards = (dataJSON) => {
        dataJSON.map((e, i)=>{
            let temporalString = "<div class='col s12 m7'><div class='card'><div class='card-content'><p><h5>"+e.name+"<h5></p><p><h6>"+e.description+"</h6></p></div><div class='card-action'><button class='btn-buy-book' value='"+e.COD_PDT+"'>Comprar Livro</button><button class='btn-add-book' value='"+e.COD_PDT+"'>Adicionar Produto</button></div></div></div>"
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
            $('#main-content').html("<h5>Lista de Produtos</h5>")
            generateCards(push)
            //$('#main-content').html(push)
        }, error: (e) => {
            $('#main-content').html("<h5>Lista de Produtos</h5>")
            $('#main-content').append("<p>Sem produtos</P")

            console.log("Error", e)
        },
    });
}

$('document').ready(()=>{
    getHome()
    $(document).on("click","#btn-home", ()=> {
        getHome()
    });
    $(document).on("click",".btn-buy-book", (e)=>{
        console.log("Comprado:", e.currentTarget.value)
        buyProduct(parseInt(e.currentTarget.value,10))
    })
    $(document).on("click",".btn-add-book", (e)=>{
        console.log("Comprado:", e.currentTarget.value)
        addProduto(parseInt(e.currentTarget.value,10))
    })
    $(document).on("click","#btn-add-product-page", (e)=>{
        getCriarProductPage()
    })
    $(document).on("click", ".btn-criar-produto", (e)=>{
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'http://127.0.0.1/ProjectBookStore/api/controller/Products/createProducts.php',
            data: $('.painel').serialize(),
            success: function (push) {
                swal(push);
                console.log(push)
            }
          });
    })
    $(document).on("click", "#btn-show-order-page", (e)=>{
        $.ajax({
            type: 'post',
            url: 'http://127.0.0.1/ProjectBookStore/api/controller/Stock/listAllOrders.php',
            success: function (push) {
                $('#main-content').html(push)
                console.log(push)
            }
          });
    })

    $(document).on("click", "#btn-show-stock-page", (e)=>{
        getStockPage();  
    })
    /*
    $('.painel').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: 'http://127.0.0.1/ProjectBookStore/api/controller/Products/createProducts.php',
          data: $('.painel').serialize(),
          success: function () {
            alert('form was submitted');
          }
        });

      });*/
})