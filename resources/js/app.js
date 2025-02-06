import './bootstrap';

import Alpine from 'alpinejs';
import {filterNonEmptyValues, clearFilter} from './commonFunction';

window.Alpine = Alpine;

Alpine.start();
window.filterNonEmptyValues = filterNonEmptyValues;
window.clearFilter = clearFilter;