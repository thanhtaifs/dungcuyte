<!-- BEGIN: main -->
<!-- BEGIN: review_edit -->
<div class="panel panel-default review-panel">
	<div class="panel-heading">{LANG.review_edit}</div>
	<div class="panel-body">
		<form action="{NV_BASE_ADMINURL}index.php" method="post">
			<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" />
			<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
			<input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
			<input type="hidden" name="save_review" value="1" />
			<input type="hidden" name="review_id" value="{REVIEW_EDIT.review_id}" />
			<div class="row">
				<div class="col-xs-24 col-sm-12">
					<div class="form-group">
						<label>{LANG.review_sender}</label>
						<input type="text" class="form-control" value="{REVIEW_EDIT.sender}" readonly="readonly" />
					</div>
				</div>
				<div class="col-xs-24 col-sm-12">
					<div class="form-group">
						<label>{LANG.review_rating}</label>
						<input type="text" class="form-control" value="{REVIEW_EDIT.rating}" readonly="readonly" />
					</div>
				</div>
				<div class="col-xs-24 col-sm-12">
					<div class="form-group">
						<label>{LANG.search_bodytext}</label>
						<textarea class="form-control" rows="3" readonly="readonly">{REVIEW_EDIT.content}</textarea>
					</div>
				</div>
				<div class="col-xs-24 col-sm-8">
					<div class="form-group">
						<label>{LANG.status}</label>
						<select class="form-control" name="moderation_status">
							<option value="pending" {REVIEW_EDIT.selected_pending}>{LANG.review_moderation_pending}</option>
							<option value="approved" {REVIEW_EDIT.selected_approved}>{LANG.review_moderation_approved}</option>
							<option value="rejected" {REVIEW_EDIT.selected_rejected}>{LANG.review_moderation_rejected}</option>
						</select>
					</div>
				</div>
				<div class="col-xs-24 col-sm-8">
					<div class="form-group">
						<label>{LANG.review_verified_purchase}</label>
						<div class="checkbox" style="margin-top: 7px;">
							<label><input type="checkbox" name="is_verified_purchase" value="1" {REVIEW_EDIT.is_verified_purchase_checked} /> {LANG.review_verified_purchase_yes}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-24 col-sm-8">
					<div class="form-group">
						<label>{LANG.review_helpful_count}</label>
						<input type="text" class="form-control" value="{REVIEW_EDIT.helpful_count}" readonly="readonly" />
					</div>
				</div>
				<div class="col-xs-24 col-sm-8">
					<div class="form-group">
						<label>{LANG.review_unhelpful_count}</label>
						<input type="text" class="form-control" value="{REVIEW_EDIT.unhelpful_count}" readonly="readonly" />
					</div>
				</div>
				<div class="col-xs-24 col-sm-8">
					<div class="form-group">
						<label>{LANG.review_spam_score}</label>
						<input type="text" class="form-control" value="{REVIEW_EDIT.spam_score}" readonly="readonly" />
					</div>
				</div>
				<div class="col-xs-24 col-sm-8">
					<div class="form-group">
						<label>{LANG.review_edited_count}</label>
						<input type="text" class="form-control" value="{REVIEW_EDIT.edited_count}" readonly="readonly" />
					</div>
				</div>
				<div class="col-xs-24 col-sm-12">
					<div class="form-group">
						<label>{LANG.review_seller_response}</label>
						<textarea class="form-control" rows="4" name="seller_response">{REVIEW_EDIT.seller_response}</textarea>
						<p class="help-block">{REVIEW_EDIT.seller_response_time}</p>
					</div>
				</div>
				<div class="col-xs-24 col-sm-12">
					<div class="form-group">
						<label>{LANG.review_rejection_reason}</label>
						<textarea class="form-control" rows="3" name="rejection_reason">{REVIEW_EDIT.rejection_reason}</textarea>
					</div>
				</div>
				<div class="col-xs-24">
					<input type="submit" class="btn btn-primary" value="{GLANG.save}" />
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END: review_edit -->

<div class="well">
	<form action="{NV_BASE_ADMINURL}index.php" method="get">
		<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" />
		<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
		<input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
		<div class="row">
			<div class="col-xs-24 col-sm-6">
				<div class="form-group">
					<input type="text" class="form-control" value="{SEARCH.keywords}" name="keywords" placeholder="{LANG.search_key}" />
				</div>
			</div>
			<div class="col-xs-24 col-sm-6">
				<div class="form-group">
					<select class="form-control" name="status">
						<option value="">---{LANG.status}---</option>
						<!-- BEGIN: status -->
						<option value="{STATUS.key}" {STATUS.selected}>{STATUS.value}</option>
						<!-- END: status -->
					</select>
				</div>
			</div>
			<div class="col-xs-24 col-sm-6">
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="{LANG.search}" />
				</div>
			</div>
		</div>
	</form>
</div>
<form>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<colgroup>
				<col class="w50" />
				<col />
				<col class="w250" />
				<col class="w100" />
				<col class="w150" />
				<col />
				<col span="2" class="w150" />
				<col class="w100" />
			</colgroup>
			<thead>
				<tr>
					<th class="text-center"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" /></th>
					<th>{LANG.name}</th>
					<th>{LANG.review_sender}</th>
					<th class="text-center">{LANG.review_rating}</th>
					<th>{LANG.review_verified_purchase}</th>
					<th>{LANG.search_bodytext}</th>
					<th>{LANG.review_add_time}</th>
					<th>{LANG.status}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN: loop -->
				<tr id="row_{VIEW.review_id}">
					<td class="text-center"><input type="checkbox" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);" value="{VIEW.review_id}" name="idcheck[]" /></td>
					<td><a href="{VIEW.link_product}" title="{VIEW.title}">{VIEW.title}</a></td>
					<td>{VIEW.sender}</td>
					<td class="text-center">{VIEW.rating}</td>
					<td>{VIEW.is_verified_purchase}</td>
					<td>{VIEW.content}</td>
					<td>{VIEW.add_time}</td>
					<td>{VIEW.status}</td>
					<td class="text-center">
						<em class="fa fa-edit fa-lg">&nbsp;</em><a href="{VIEW.edit_link}">{GLANG.edit}</a>
						&nbsp;|&nbsp;
						<em class="fa fa-trash-o fa-lg">&nbsp;</em><a href="javascript:void(0)" title="{GLANG.delete}" onclick="nv_del_review({VIEW.review_id})">{GLANG.delete}</a>
					</td>
				</tr>
				<!-- END: loop -->
			</tbody>
			<!-- BEGIN: generate_page -->
			<tfoot>
				<tr class="text-center">
					<td colspan="9">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<!-- END: generate_page -->
		</table>
	</div>
	<select class="form-control w200 pull-left" id="action" name="action">
		<option value="delete">{LANG.prounit_del_select}</option>
		<option value="review_status_approved">{LANG.review_moderation_approved}</option>
		<option value="review_status_pending">{LANG.review_moderation_pending}</option>
		<option value="review_status_rejected">{LANG.review_moderation_rejected}</option>
	</select>&nbsp;
	<input type="button" class="btn btn-primary" onclick="nv_review_action(this.form, '{LANG.prounit_del_no_items}')" value="{LANG.action}" />
</form>
<!-- END: main -->
