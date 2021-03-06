<?php
//
// ZoneMinder web run state view file, $Date$, $Revision$
// Copyright (C) 2001-2008 Philip Coombes
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
//
global $running;

if ( !canEdit('System') ) {
  $view = 'error';
  return;
}
?>
<div id="modalState" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
	        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          <h5 class="modal-title w-100 text-center" id="ModalCenterTitle"><?php echo translate('RunState') ?></h5>
        </div>

        <div class="modal-body">
          <form class="" name="contentForm" method="get" action="?view=state">
           <input type="hidden" name="view" value="state"/>
           <input type="hidden" name="action" value="state"/>
           <input type="hidden" name="apply" value="1"/>

	        <div class="form-group">
	          <label for="runState" class="col-md-3 col-form-label float-left">Change State</label>
	          <div class="col-md-9">
              <select id="runState" name="runState" class="form-control">
<?php 
if ( $running ) {
?>
                <option value="stop" selected="selected"><?php echo translate('Stop') ?></option>
                <option value="restart"><?php echo translate('Restart') ?></option>
<?php
} else {
?>
                <option value="start" selected="selected"><?php echo translate('Start') ?></option>
<?php
}
$states = dbFetchAll('SELECT * FROM States');
foreach ( $states as $state ) {
?>
                <option value="<?php echo validHtmlStr($state['Name']) ?>" <?php echo $state['IsActive'] ? 'selected="selected"' : '' ?>>
                <?php echo validHtmlStr($state['Name']); ?>
                </option>
<?php
}
?>
              </select>
	          </div><!--col-md-9-->
	        </div><!--form-group-->
	        <div class="form-group">
            <label for="newState" class="col-md-3 col-form-label float-left"><?php echo translate('NewState') ?></label>
		        <div class="col-md-9">
              <input class="form-control" type="text" id="newState"/>
		        </div>
	        </div>
          </form>
        </div> <!-- modal-body -->
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" id="btnApply"><?php echo translate('Apply') ?></button>
          <button class="btn btn-primary" type="button" id="btnSave" disabled><?php echo translate('Save') ?></button>
          <button class="btn btn-danger" type="button" id="btnDelete" disabled><?php echo translate('Delete') ?></button>
          <p class="pull-left hidden" id="pleasewait"><?php echo translate('PleaseWait') ?></p>
	      </div><!-- footer -->
      </div> <!-- content -->
    </div> <!-- dialog -->
</div> <!-- state -->
