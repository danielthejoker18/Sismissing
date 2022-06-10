var id =0;
function getZap(e){
  var user_id = $(e).attr("id");
  typeof(user_id);
  id = user_id;
  //alert(user_id);
  //Verificar se há valor na variável "user_id".
  if(user_id){
    var dados = {
      user_id: user_id
    };
    $.post('visualizar.php', dados, function(retorna){
      //Carregar o conteúdo para o usuário
      $("#visul_usuario").html(retorna);
      $('#visulUsuarioModal').modal('show');
    });
  }
};
function copyZap(){
  //console.log(id);
  var user_id = parseInt(id);
  //alert(user_id);
  //Verificar se há valor na variável "user_id".
  if(user_id){
    var dados = {
      user_id: user_id
    };
    //console.log(user_id);
    $.post('copiar.php', dados, function(retorna){
      //console.log(retorna);
      const textarea = document.createElement("textarea");
      textarea.setAttribute("id", "zapCopied");
      document.body.appendChild(textarea);

      $("#zapCopied").html(retorna);
      textarea.select()
      document.execCommand('copy');
      document.body.removeChild(textarea);
	  swal.fire('Resumo Copiado!')
    });
  }
};
