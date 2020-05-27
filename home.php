
<html>
  <head>
    <meta charset="utf-8" />
    <title>Simplex</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
     </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        Simplex
      </a>
    </nav>
    <div class="container">    
      <div class="row">
        <div class="index">
          <div class="card">
            <div class="card-header">
              Simplex
            </div>
            <div class="card-body">
              <form action="tabela_inicial.php" method="post">
                    <div class="form-group">
                      <label>Limite máximo de interações</label>
                      <select name="interacoes" class="form-control">
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Quantidade de variaveis de decisão</label>
                      <select name="quant_var_decisao" class="form-control">
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Quantidade de restrições</label>
                      <select name="quant_var_restricao" class="form-control">
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>  
                <button class="btn btn-lg btn-info btn-block" type="submit">Começar</button>
              </form>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>