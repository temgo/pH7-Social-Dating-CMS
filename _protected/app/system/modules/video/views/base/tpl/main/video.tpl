<div class="center">

{@if(empty($error))@}

<h3>{% Framework\Security\Ban\Ban::filterWord($video->title) %}</h3>

{{ VideoDesign::generate($video, 'movie', 680, 440) }}

<p>{% nl2br(Framework\Parse\Emoticon::init(Framework\Security\Ban\Ban::filterWord($video->description))) %}</p>
<p class="italic">{@lang('Album created on %0%.', $video->createdDate)@} {@if(!empty($video->updatedDate))@} <br>{@lang('Modified on %0%.', $video->updatedDate)@} {@/if@}</p>
<p class="italic">{@lang('Views:')@} {% Framework\Mvc\Model\StatisticModel::getView($video->videoId,'Videos') %}</p>

 {@if(UserCore::auth() && $member_id == $video->profileId)@}
   <div class="small">
   <a href="{{$design->url('video', 'main', 'editvideo', "$video->albumId,$video->title,$video->videoId")}}">{@lang('Edit')@}</a> |
   {{ LinkCoreForm::display(t('Delete'), 'video', 'main', 'deletevideo', array('album_title'=>$video->name, 'album_id'=>$video->albumId, 'video_id'=>$video->videoId, 'video_link'=>$video->file)) }}
   </div>
 {@/if@}

{{ ShareUrlCoreForm::display(Framework\Mvc\Router\UriRoute::get('video','main','video',"$video->username,$video->albumId,$video->title,$video->videoId")) }}
{{ RatingDesignCore::voting($video->videoId,'Videos','center') }}
{{ CommentDesignCore::link($video->videoId, 'Video') }}

<p class="center">{{ $design->like($video->username, $video->firstName, $video->sex) }} | {{ $design->report($video->profileId, $video->username, $video->firstName, $video->sex) }}</p>
{{ $design->likeApi() }}

{@else@}

<p>{error}</p>

{@/if@}

</div>