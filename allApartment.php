
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                <?php
                include "apartmentQuery.php";
                $cnt=0;
                while($row = mysqli_fetch_assoc($result)){
                    if($cnt==6 && $_SESSION['apart_cnt'] == 0) break;
                    $cnt++;
                ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                            <a href="apartmentDetails.php?id=<?php echo $row['appart_id']; ?>"><img class="img-fluid" src="./img/<?php echo $row['title_img']; ?>" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3"><?php echo $row['price']; ?></h5>
                                <a class="d-block h5 mb-2" href="apartmentDetails.php?id=<?php echo $row['appart_id']; ?>"><?php echo $row['title']; ?></a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo "<span>".$row['thana']. ", " .$row['district']."</span>"; ?></p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i><?php echo $row['sqft']; ?>sqft</small>
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i><?php echo $row['bedroom_num']; ?> Bed</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i><?php echo $row['bathroom_num']; ?> Bath</small>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    $conn -> close();
                    $_SESSION['apart_cnt'] = 0;
                    ?>
                </div>
            </div>
            
        </div>