'use strict';

angular.module('api.version', [
  'api.version.interpolate-filter',
  'api.version.version-directive'
])

.value('version', '0.1');
