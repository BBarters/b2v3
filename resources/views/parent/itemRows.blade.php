
@if(count($articles)>0)
@foreach($articles as $article)
<li class="withripple"  >
   <a id="{{$article->id}}" class="items" href="#">
  <!--  <input id="articleId" type="hidden" value="{{$article->id}}">
  -->
    <div class="list-group-item" >
    <div class="row-action-primary">
        <i class="mdi-file-folder"></i>
    </div>
    <div class="row-content">
        <div class="least-content"></div>
        <h4 class="list-group-item-heading">{{$article->title}}</h4>
        <p class="list-group-item-text">{{$article->description}}</p>
    </div>
</div>
<div class="list-group-separator"></div>
   </a>
</li>
@endforeach
@else
<div class="list-group-item">
    <div class="row-action-primary">
    </div>
    <div class="row-content">
        <div class="least-content"></div>
        <h4 class="list-group-item-heading">Sorry</h4>
        <p class="list-group-item-text">No available content is here at the moment.</p>
    </div>
</div>
@endif