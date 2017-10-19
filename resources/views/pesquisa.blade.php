@section('title','Sistema Post 2 - Página de Pesquisa')
@extends('layouts.app')

@section('content')
<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>

<div class="container" id="sistema-pesquisa">
  <div class="row">
    <div class="col-md-offset-1 col-md-8">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Pesquisar</h3>
          </div>
          <div class="panel-body">
            <input type="text" class="form-control" v-on:keyup="pesquisar" v-model="apesquisar">
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <h4>@{{msg}}</h4>
      </div>

      <div class="col-md-12">
        <div class="panel panel-default" v-for="item in textos">
          <div class="panel-heading">
            <h3 class="panel-title"> @{{item.titulo}} </h3>
          </div>
          <div class="panel-body" style="padding:0px;" align="center">
              <img v-bind:src=" item.imagem " class="img-responsive">
          </div>
          <div class="panel-footer">
            <a v-bind:href="'post/'+item.categoria+'/'+item.slug" class="btn btn-success" role="button">Visualizar</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
var app = new Vue({
el: '#sistema-pesquisa',
data: {
 msg:'',
 apesquisar:'',
 textos:[]
},
methods:{
  pesquisar: function(){
    if(this.apesquisar.length>=3){
      this.msg = 'Pesquisando...';
      this.$http.get("{!! url('pesquisar') !!}",{params:{pesquisar:this.apesquisar}}).then(response => {
        this.textos = response.body;
        if(this.textos.length!=0){
          this.msg = this.textos.length+' Resultados';
        }else{
          this.msg = 'Nenhum Texto Fui Encontrado!!!';
          this.textos = [];
        }
      });

    }else{
      this.msg = '';
    }
  }
}
})
</script>
@endsection
