<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="h4"></h4>
        </div>
        <div class="modal-body">
          <b></b><br><br>
          <form>
          <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" required="">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" required="">
    </div>
    <div class="form-group">
      <label id="lpass" for="pass">Password:</label>
      <input type="password" class="form-control" id="pass" required="">
    </div>
    <label id="lg">Gender: </label>
    <label class="lbl"><input type="radio" value="Male" name="gender" checked required>Male</label> 
    <label class="lbl"><input type="radio" value="Female" name="gender" required>Female</label><br><br>
    <label for="country">Country:</label>
      <select class="form-control" id="country" required>
        <option value="">--Select--</option>
        <option value="Algeria">Algeria</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Denmark">Denmark</option>
      </select>
      {{-- <br><button type="button" class="btn btn-info btn-lg" id="sub" onclick="submit()">Submit</button><br><br> --}}
      <br><input type="submit"><br>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  