import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {AppManagerModule} from '../../app-manager/app-manager.module';
import {RecordSettingsMenuComponent} from './record-settings-menu.component';
import {ColumnchooserUiModule} from '../columnchooser/columnchooser.module';
import {ImageModule} from '@components/image/image.module';
import {ButtonModule} from '@components/button/button.module';

@NgModule({
    declarations: [RecordSettingsMenuComponent],
    exports: [RecordSettingsMenuComponent],
    imports: [
        CommonModule,
        AppManagerModule.forChild(RecordSettingsMenuComponent),
        ColumnchooserUiModule,
        ImageModule,
        ButtonModule
    ]
})
export class RecordSettingsMenuModule {
}