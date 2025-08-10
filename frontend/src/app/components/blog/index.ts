import {PostListComponent} from './posts/post-list/post-list.component';
import {PostDetailComponent} from './posts/post-detail/post-detail.component';
import {PostCreateComponent} from './posts/post-create/post-create.component';
import {PostUpdateComponent} from './posts/post-update/post-update.component';
import {CommentListComponent} from './comments/comment-list/comment-list.component';
import {CommentCreateComponent} from './comments/comment-create/comment-create.component';
import {CommentUpdateComponent} from './comments/comment-update/comment-update.component';
import {CommentDetailComponent} from './comments/comment-detail/comment-detail.component';


export const components: any[]  = [
  PostListComponent,
  PostDetailComponent,
  PostCreateComponent,
  PostUpdateComponent,
  CommentListComponent,
  CommentCreateComponent,
  CommentUpdateComponent,
  CommentDetailComponent
];

export * from './posts/post-list/post-list.component';
export * from './posts/post-detail/post-detail.component';
export * from './posts/post-create/post-create.component';
export * from './posts/post-update/post-update.component';
export * from './comments/comment-list/comment-list.component';
export * from './comments/comment-create/comment-create.component';
export * from './comments/comment-update/comment-update.component';
export * from './comments/comment-detail/comment-detail.component';
