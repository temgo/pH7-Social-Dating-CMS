{@if(empty($error))@}

{@foreach($album as $a)@}

{* Set Video Album Statistics *}
{{ Framework\Analytics\Statistic::setView($a->albumId, 'AlbumsVideos') }}

 <div class="m_photo center">

  {{ $absolute_url = Framework\Mvc\Router\UriRoute::get('video','main','video',"$a->username,$a->albumId,$a->title,$a->videoId") }}

  <h4><a href="{absolute_url}">{% substr(Framework\Security\Ban\Ban::filterWord($a->title),0,25) %}</a></h4>
   {{ VideoDesign::generate($a, 'preview', 600, 400) }}

  {@if(UserCore::auth() && $member_id == $a->profileId)@}
    <div class="small">
    <a href="{{$design->url('video', 'main', 'editvideo', "$a->albumId,$a->title,$a->videoId")}}">{@lang('Edit')@}</a> |
    {{ LinkCoreForm::display(t('Delete'), 'video', 'main', 'deletevideo', array('album_title'=>$a->name,'album_id'=>$a->albumId,'video_id'=>$a->videoId,'video_link'=>$a->file)) }}
    </div>
  {@/if@}

  <p>
   {{ RatingDesignCore::voting($a->videoId,'Videos') }}
   {{$design->like($a->username,$a->firstName,$a->sex,$absolute_url)}} | {{$design->report($a->profileId, $a->username, $a->firstName, $a->sex)}}
  </p>

 </div>

{@/foreach@}

{@main_include('page_nav.inc.tpl')@}

 {@if(UserCore::auth() && $member_id == $a->profileId)@}
  <p class="center bottom"><a class="m_button" href="{{$design->url('video', 'main', 'addvideo', $a->albumId)}}">{@lang('Add new videos')@}</a></p>
 {@/if@}

{@else@}

<p>{error}</p>

{@/if@}
