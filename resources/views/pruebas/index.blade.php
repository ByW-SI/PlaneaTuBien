<div class="container">

    <form id="formu" method="POST" target="_blank">
    JWT: <input type="text" name="jwt"><br>
    <input type="submit" value="Submit">
    </form>
    <p>Click on the submit button, and the input will be sent to a page on
    the server called "/action_page.php".</p>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script>

const baseUrl = 'http://certificaciones.netpay.com.mx:4030/gateway-ecommerce';
// const baseUrl = 'https://cert.netpay.com.mx/gateway-ecommerce';

$(document).ready( async function(){

    const response = await $.ajax({
        url: `${baseUrl}/v1/auth/login`,
        contentType: 'Application/Json',
        type: 'POST',
        data: `
        {
            "security":
                {
                    "userName": "ecommerce@netpay.com.mx",
                    "password": "ec0m12"
                }
        }
        `,
        success: function(data){
            // console.log(data.token)
        },
        error: function(err){
            // console.log(err)
        }
    });

    console.log(response.token);

    datosNetPay = 
        {
            "storeIdAcq":"483131",
            "transType":"Auth",
            "promotion":"000000",
            "checkout":{
            "merchantReferenceCode":"145000494",
            "bill":{
            "city":"Guadalupe",
            "country":"MX",
            "firstName":"Heriberto",
            "lastName":"Hernandez",
            "email":"accept@netpay.com.mx",
            "phoneNumber":"8119654348",
            "postalCode":"34987",
            "state":"Campeche",
            "street1":"una calle",
            "street2":"otra calle",
            "ipAddress":"127.0.0.1"
            },
            "ship":{
            "city":"Guadalupe",
            "country":"MX",
            "firstName":"Heriberto",
            "lastName":"Hernandez",
            "phoneNumber":"8119654348",
            "postalCode":"34987",
            "state":"Nuevo Leon",
            "street1":"una calle",
            "street2":"otra calle",
            "shippingMethod":"flatrate_flatrate"
            },
            "itemList":[
                {
                    "id":"421",
                    "productSKU":"wbk012c-Royal Blue-S",
                    "unitPrice":"1.00",
                    "productName":"Elizabeth Knit Top",
                    "quantity":1,
                    "productCode":"Tops & Blouses"
                }
            ],
            "purchaseTotals":{
            "grandTotalAmount":"3",
            "currency":"MXN"
            },
            "merchanDefinedDataList":[
            {"id":2,
            "value":"Web"},
            {"id":4,
            "value":"515"},
            {"id":5,
            "value":"0"},
            {"id":6,
            "value":"0"},
            {"id":7,
            "value":"0"},
            {"id":9,
            "value":"Retail"},
            {"id":10,
            "value":"3D"},
            {"id":11,
            "value":"flatrate_flatrate"},
            {"id":13,
            "value":"N"},
            {"id":14,
            "value":"Domicilio"},
            {"id":"16",
            "value":"50000"}
            ]
            }
        }

    console.log(datosNetPay.checkout.itemList)
    datosNetPay.checkout.itemList.push({
                    "id":"421",
                    "productSKU":"wbk012c-Royal Blue-S",
                    "unitPrice":"1.00",
                    "productName":"Elizabeth Knit Top",
                    "quantity":1,
                    "productCode":"Tops & Blouses"
                });
    console.log(datosNetPay.checkout.itemList)

    const response2 = await $.ajax({
        url: `${baseUrl}/v2/checkout`,
        headers: {
            'content-Type' : "Application/Json",
            'Authorization' : `Bearer ${response.token}`,
        },
        type: 'POST',
        data: JSON.stringify(datosNetPay)
        
        ,
        success: function(data){
            //console.log(data)
        },
        error: function(err){
            // console.log(err)
        }
    });

    console.log(response2)

    // const ruta = `http://certificaciones.netpay.com.mx:7092/a-webapp/e-commerce/web-authorizer?checkoutTokenId=0a377ca8-e26c-4f22-a751-52719acf9019&checkoutDetail=true`;

    const MerchantResponseURL = btoa('https://www.google.com');
    console.log( MerchantResponseURL )
    url = 'https://ecommerce.netpay.com.mx';

    // const ruta = `http://certificaciones.netpay.com.mx:7092/a-webapp/e-commerce/web-authorizer?checkoutTokenId=${response2.response.checkoutTokenId}`;
    // const ruta = `http://certificaciones.netpay.com.mx:7092/a-webapp/e-commerce/web-authorizer?checkoutTokenId=${response2.response.checkoutTokenId}&checkoutDetail=true&MerchantResponseURL=${MerchantResponseURL}`;
    const ruta = `${url}/a-webapp3/e-commerce/web-authorizer?checkoutTokenId=${response2.response.checkoutTokenId}&checkoutDetail=true&MerchantResponseURL=${MerchantResponseURL}`;

    $('#formu').attr('action', ruta);
    $('#formu').submit();
    
} );

</script>