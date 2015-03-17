'use strict';

describe('api.version module', function() {
  beforeEach(module('api.version'));

  describe('version service', function() {
    it('should return current version', inject(function(version) {
      expect(version).toEqual('0.1');
    }));
  });
});
