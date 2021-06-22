<?php /***
 * @var $catalog \models\Catalog;
 */
?>
<div class="select-mean">
    <h2>Cum doriti sa calculam media: </h2>
    <br>
    <div class="container">
        <select>
            <option value="mediaArtimetica">Media aritmetica</option>
            <option value="mediaPatratica">Media patratica</option>
            <option value="calculator">Calculator</option>
        </select>
    </div>
</div>
<div class="main-box" id="catalog">
    <div class="page-aligned-catalog">
        <br><br>

        <table class="blueTable" id="tblCatalog" style="width: 90%; height: 40%;">
            <thead>
            <tr>
                <th>Nume</th>
                <th>Prenume</th>
                <?php use models\Attendance;
                $count = 0;
                $studentRowNr = -1;
                foreach ($catalog->assignments as $assignment): ?>
                    <th><?php echo $assignment->title ?></th>
                    <th>Prezenta - Lab<?php echo ++$count ?></th>
                <?php endforeach; ?>

                <th> Prezente</th>
                <th> Media generala</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($catalog->students as $student):
                $countAttendance = $count;
                $studentRowNr++;
                ?>
                <tr>
                    <td><?php echo $student->lastname ?></td>
                    <td><?php echo $student->firstname ?></td>
                    <?php foreach ($catalog->assignments as $assignment): ?>
                        <td>
                            <?php echo $grade[$studentRowNr][] = $student->getStudentWorkForAssignment($assignment->id)->getGrade() ?>
                        </td>
                        <?php if ($assignment->code_attendance == false): ?>
                            <td>Nu s-a facut prezenta</td>
                        <?php elseif (Attendance::confirmAttendance($student->id, $assignment->id)): ?>
                            <td>Prezent</td>
                        <?php else: $countAttendance--; ?>
                            <td>Absent</td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <td><?php echo $countAttendance; ?></td>
                    <td><h3>Nota</h3></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <br>

    </div>
</div>

<button type="button" onclick="createPDF()">
    Export in format PDF
</button>

<button type="button" onclick="createCSV()">
    Export in format CSV
</button>

<button type="button" onclick="createHTML()">
    Export in format HTML
</button>

<div class="container-calculator">
    <div class="main-calculator hidden" id="calculator">
        <form name="form-calculator">
            <input class="textview-calculator" name="textViewCalculator" id="textViewCalculator">
        </form>

        <table>
            <tr>
                <td><input class="button-calculator" type="button" value="Round" onclick="round()"></td>
                <td><input class="button-calculator" type="button" value="Floor" onclick="floor()"></td>
                <td><input class="button-calculator" type="button" value="<=" onclick="deleteDigit()"></td>
                <td><input class="button-calculator" type="button" value="/" onclick="insertCatalog('/')"></td>
            </tr>
            <tr>
                <td><input class="button-calculator" type="button" value="7" onclick="insertCatalog(7)"></td>
                <td><input class="button-calculator" type="button" value="8" onclick="insertCatalog(8)"></td>
                <td><input class="button-calculator" type="button" value="9" onclick="insertCatalog(9)"></td>
                <td><input class="button-calculator" type="button" value="x" onclick="insertCatalog('*')"></td>
            </tr>
            <tr>
                <td><input class="button-calculator" type="button" value="4" onclick="insertCatalog(4)"></td>
                <td><input class="button-calculator" type="button" value="5" onclick="insertCatalog(5)"></td>
                <td><input class="button-calculator" type="button" value="6" onclick="insertCatalog(6)"></td>
                <td><input class="button-calculator" type="button" value="-" onclick="insertCatalog('-')"></td>
            </tr>
            <tr>
                <td><input class="button-calculator" type="button" value="1" onclick="insertCatalog(1)"></td>
                <td><input class="button-calculator" type="button" value="2" onclick="insertCatalog(2)"></td>
                <td><input class="button-calculator" type="button" value="3" onclick="insertCatalog(3)"></td>
                <td><input class="button-calculator" type="button" value="+" onclick="insertCatalog('+')"></td>
            </tr>
            <tr>
                <td><input class="button-calculator" type="button" value="c" onclick="clean()"></td>
                <td><input class="button-calculator" type="button" value="0" onclick="insertCatalog(0)"></td>
                <td><input class="button-calculator" type="button" value="." onclick="insertCatalog('.')"></td>
                <td><input class="button-calculator" type="button" value="=" onclick="equal()"></td>
            </tr>

        </table>

    </div>
</div>

<script src="/js/main.js"></script>

<script>
    let grades = <?php echo json_encode($grade); ?>;
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>

<script src="/js/catalog.js"></script>