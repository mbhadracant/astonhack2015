<!DOCTYPE html>
<html lang="en">

<head>
    <title>Report A Problem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="main-forum.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js">
    </script>
</head>

<body>

    <div class="container">
     <h1 style="font-size:60px; text-align:center;">Report A Problem</h1>
        <form action="insert.php" method="post">
            <div class="forum">

                <div class="forum-display">
                    <h1>Incident details</h1>
                    <div class="form-group">
                        <label for="problemType">What type of problem? </label>
                        <select class="form-control" name="inciCategory">
                            <option>Please Select</option>
                            <option>Water leak</option>
                            <option>General Water Supply Issue</option>
                            <option>Drain Issue</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>


                <div class="forum-display">
                    <h1>Incident location</h1>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="inciLocation" class="form-control" id="address">
                    </div>
                    <div class="form-group">
                        <label for="address">Town / City:</label>
                        <input type="text" name="inciTownCity" class="form-control" id="town-city">
                    </div>
                    <div class="form-group">
                        <label for="postcode">Post Code:</label>
                        <input type="text" name="inciPostCode" class="form-control" id="postcode">
                    </div>
                </div>

                <div class="water-leak forum-display">
                    <h1>Water Leak</h1>

                    <div class="form-group">
                        <label for="waterLocation">here is the incident happening? </label>
                        <select class="form-control" name="waterLocation">
                            <option>Please Select</option>
                            <option>My home</option>
                            <option>On my internal meter</option>
                            <option>On my external meter</option>
                            <option>In my property</option>
                            <option>On a public road</option>
                            <option>In another public area</option>
                        </select>
                    </div>


                    <br>
                    <br>

                    <div class="form-group">
                        <label for="howBad">How bad is the leak? </label>
                        <select class="form-control" name="howBad">
                            <option>Please Select</option>
                            <option>Fast running</option>
                            <option>Slow running</option>
                            <option>Trickling</option>
                        </select>
                    </div>

                    <br>
                    <br>

                    <div class="form-group">
                        <label for="causingDamage">Is it causing damage? </label>
                        <select class="form-control" name="causingDamage">
                            <option>Please Select</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                </div>


                <div class="general-water forum-display">
                    <h1>General water supply issue</h1>
                    <div class="form-group">
                        <label for="coldTap">Is the problem at cold tap nearest your stop tap? </label>
                        <select class="form-control" name="coldTap">
                            <option>Please Select</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                    <br>
                    <br>

                    <div class="form-group">
                        <label for="supplyIssue">What type of water supply issue do you have? </label>
                        <select class="form-control" name="supplyIssue">
                            <option>Please Select</option>
                            <option>Discolouration</option>
                            <option>Smell</option>
                            <option>Taste</option>
                            <option>Low pressure</option>
                            <option>High pressure</option>
                            <option>No supply</option>
                            <option>Other water issue</option>
                        </select>
                    </div>



                    <div class="water-issue-other other-display">

                        <div class="form-group">
                            <label for="desc">Briefly describe the issue you have:</label>
                            <textarea class="form-control" name = "waterOtherIssue" rows="5" id="desc"></textarea>
                        </div>

                    </div>

                </div>



                <div class="drain-issue forum-display">
                    <h1>Drain issue</h1>
                    
                    <div class="form-group">
                        <label for="drainIssue">What type of drain issue do you have?  </label>
                        <select class="form-control" name="drainIssue">
                            <option>Please Select</option>
                            <option>Flooding my house</option>
                            <option>Flooding my garden</option>
                            <option>Flooding public area</option>
                            <option>Seeping manhole</option>
                            <option>Blockage</option>
                            <option>smell</option>
                            <option>Other drain issue</option>
                        </select>
                    </div>

                    <div class="drain-issue-other other-display">

                        <div class="form-group">
                            <label for="desc">Briefly describe the issue you have:</label>
                            <textarea class="form-control" name="drainOtherIssue" rows="5" id="desc"></textarea>
                        </div>

                    </div>
                </div>

                <div class="other other-display">
                    <h1>Other issue</h1>
                    <div class="form-group">
                        <label for="desc">Briefly describe the issue you have:</label>
                        <textarea class="form-control" name="other" rows="5" id="desc"></textarea>
                    </div>

                </div>


                <div class="forum-display user-details">
                    <h1>Your Details</h1>
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" name="fullName" class="form-control" id="usr">
                    </div>
                    <div class="form-group">
                        <label for="tele">Telephone:</label>
                        <input type="text" name="telephone" class="form-control" id="tele">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" name="address" class="form-control" id="address">
                    </div>
                    <div class="form-group">
                        <label for="postcode">Post Code:</label>
                        <input type="text" name="postcode" class="form-control" id="postcode">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" class="form-control" id="email">
                    </div>


                    <button type="submit" class="btn btn-success">Submit</button>
                    <br>
                </div>
            </div>

        </form>
    </div>
    <script src="forum.js"></script>
</body>

</html>