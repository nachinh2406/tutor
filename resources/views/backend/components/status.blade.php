<div class="mb-1">
    <label class="form-label" for="status">Trạng thái</label>
    <select class="form-select" name="status" id="status" required>
        <option {{$object->status == INACTIVE ? "selected" : ""}}  value="0">Chưa kích hoạt</option>
        <option {{$object->status == ACTIVE ? "selected" : ""}}  value="1">Kích hoạt</option>
    </select>
</div>
