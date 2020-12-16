const restify =  require('restify');
const errors = require('restify-errors');

const servidor = restify.createServer({
    name: 'mercado',
    version: '1.0.0'
});

servidor.use( restify.plugins.acceptParser(servidor.acceptable) );
servidor.use( restify.plugins.queryParser() );
servidor.use( restify.plugins.bodyParser() );

servidor.listen(8001 , function(){
    console.log("%s executando em %s", servidor.name, servidor.url);
});

var knex = require('knex')({
    client: 'mysql',
    connection: {
        host: 'localhost',
        user: 'root',
        password: '',
        database: 'mercado'
    }
});

// lista todos os produtos
servidor.get('/produtos', (req, res, next) => {
    knex('tbl_produtos').then( (dados) =>{
        res.send( dados )
    } , next );

});

//adiciona os produtos
servidor.post('/produtos/add', (req, res, next) => {
    knex('tbl_produtos')
    .insert( req.body )
        .then( (dados) =>{
            res.send( dados )
    } , next );

});