import {Component} from '@angular/core';
import {RecordViewStore} from '@views/record/store/record-view/record-view.store';
import {ModuleNavigation} from '@services/navigation/module-navigation/module-navigation.service';
import {combineLatest} from 'rxjs';
import {map} from 'rxjs/operators';
import {RecordActionsAdapter} from '@views/record/adapters/actions.adapter';

@Component({
    selector: 'scrm-record-header',
    templateUrl: 'record-header.component.html',
    providers: [RecordActionsAdapter]
})
export class RecordHeaderComponent {

    displayResponsiveTable = false;

    vm$ = combineLatest([
        this.recordViewStore.record$
    ]).pipe(
        map((
            [
                record
            ]
        ) => ({
            record
        }))
    );

    constructor(protected recordViewStore: RecordViewStore, protected moduleNavigation: ModuleNavigation) {
    }

    get moduleTitle(): string {
        const module = this.recordViewStore.vm.appData.module;
        const appListStrings = this.recordViewStore.vm.appData.language.appListStrings;
        return this.moduleNavigation.getModuleLabel(module, appListStrings);
    }
}