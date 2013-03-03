<div class="center">

{@if(empty($error))@}

 <article>
 <time datetime="{% (!empty($post->updatedDate)) ? $dateTime->get($post->updatedDate)->dateTime() : $dateTime->get($post->createdDate)->dateTime() %}" pubdate="pubdate"></time>

  {{ $content = Framework\Parse\Emoticon::init(Framework\Security\Ban\Ban::filterWord($post->content)) }}

  <div class="left"><h4>{@lang('Author: <a href="%0%">%1%</a>.', (new UserCore)->getProfileSignupLink($post->username, $post->firstName, $post->sex), $post->firstName)@}</h4>{{ NoteDesign::getThumb($post) }}</div>

  {content}

 <br /><hr />
 <p>{@lang('Categories:')@}<span class="small italic">
 {@foreach($categories as $category)@}
   <a href="{{ $design->url('note','main','category', "$category->name,title,asc") }}">{% $category->name %}</a> &bull;
 {@/foreach@}
 </span></p>

{{ $design->like($post->username,$post->firstName,$post->sex) }} | {{ $design->report($post->profileId,$post->username,$post->firstName,$post->sex) }}

 <p class="small italic">{@lang('Posted on:')@} {% $dateTime->get($post->createdDate)->dateTime() %} {@if(!empty($post->updatedDate))@} | {@lang('Updated Post:')@}{% $dateTime->get($post->updatedDate)->dateTime() %}{@/if@} | {@lang('Views:')@} {% Framework\Mvc\Model\StatisticModel::getView($post->noteId,'Notes') %}</p>

 {@if(UserCore::auth() && $member_id === $post->profileId)@}
  <p><a class="m_button" href="{{ $design->url('note','main','edit',$post->noteId) }}">{@lang('Edit Article')@}</a> | {{ $design->popupLinkConfirm(t('Delete Article'), 'note', 'main', 'delete', $post->noteId, 'm_button') }}</p>
 {@/if@}

 {{ ShareUrlCoreForm::display(Framework\Mvc\Router\UriRoute::get('note','main','read',"$post->username,$post->postId")) }}
 {{ RatingDesignCore::voting($post->noteId,'Notes','center') }}

 {{ $design->likeApi() }}

 {@if($post->enableComment)@}
    <p>------------------------------------</p>
    {{ CommentDesignCore::link($post->noteId,'Note') }}
 {@/if@}

{@if(AdminCore::auth() && !(new Framework\Session\Session)->exists('login_user_as'))@}
  {{ $action = ($post->approved == 1) ? 'disapproved' : 'approved' }}
  {{ $text = ($post->approved == 1) ? t('Disapprove') : t('Approve') }}
  <p><hr />{{ LinkCoreForm::display($text, 'note', 'admin', $action, array('note_id'=>$post->noteId, 'post_id'=>$post->postId, 'profile_id'=>$post->profileId)) }} | <a class="m_button" href="{{ $design->url(PH7_ADMIN_MOD,'user','loginuseras',$post->profileId) }}" title="{@lang('Login as this author to edit his post')@}">{@lang('Login as this User')@}</a></p>
{@/if@}

</article>

{@else@}

 <p>{error}</p>

{@/if@}

</div>