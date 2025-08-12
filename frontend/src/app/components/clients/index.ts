import {ClientListComponent} from './client-list/client-list.component';
import {ClientDetailComponent} from './client-detail/client-detail.component';
import {ClientCreateComponent} from './client-create/client-create.component';
import {ClientUpdateComponent} from './client-update/client-update.component';
import {ClientJobListComponent} from './client-job-list/client-job-list.component';



export const components: any[] = [
  ClientListComponent,
  ClientDetailComponent,
  ClientCreateComponent,
  ClientUpdateComponent,
  ClientJobListComponent
];

export * from './client-list/client-list.component';
export * from './client-detail/client-detail.component';
export * from './client-create/client-create.component';
export * from './client-update/client-update.component';
export * from './client-job-list/client-job-list.component';
