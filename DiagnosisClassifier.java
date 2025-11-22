import weka.core.Instance;
import weka.core.Instances;
import weka.core.DenseInstance;
import weka.classifiers.Classifier;
import java.io.*;

public class DiagnosisClassifier {
    public static void main(String[] args) {
        try {
            // Validate input
            if (args.length != 1 || !args[0].contains(",")) {
                System.out.println("Error: Expected a single CSV string as input.");
                return;
            }

            String inputLine = args[0]; // e.g., "Yes,No,Yes,..."

            // Load ARFF structure
            BufferedReader reader = new BufferedReader(new FileReader("malaria.arff"));
            Instances structure = new Instances(reader);
            structure.setClassIndex(structure.numAttributes() - 1); // last attribute is class

            // Convert input to instance
            String[] values = inputLine.split(",");
            double[] instanceValues = new double[structure.numAttributes()];

            for (int i = 0; i < values.length && i < structure.numAttributes() - 1; i++) {
                instanceValues[i] = values[i].equalsIgnoreCase("Yes") ? 0 : 1; // "Yes" = 0, "No" = 1
            }

            Instance instance = new DenseInstance(1.0, instanceValues);
            instance.setDataset(structure);

            // Load tuned model
            Classifier classifier = (Classifier) weka.core.SerializationHelper.read("malaria_multiclass_tuned.model");

            // Predict class
            double result = classifier.classifyInstance(instance);
            String predictedClass = structure.classAttribute().value((int) result);

            // Optional: print confidence scores
            double[] distribution = classifier.distributionForInstance(instance);
            System.out.println(predictedClass);
            // Uncomment below to show probabilities
            // for (int i = 0; i < distribution.length; i++) {
            //     System.out.println(structure.classAttribute().value(i) + ": " + distribution[i]);
            // }

        } catch (Exception e) {
            System.out.println("Error: " + e.getMessage());
        }
    }
}