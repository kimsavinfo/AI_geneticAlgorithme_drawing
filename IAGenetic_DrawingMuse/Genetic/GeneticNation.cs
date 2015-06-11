using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System.Drawing;
using IAGenetic_DrawingMuse.Genetic;
using System.Threading;
using System.Windows.Forms;

namespace IAGenetic_DrawingMuse.Genetic
{
    class GeneticNation
    {
        private int widthTotal;
        private int heightTotal;
        private int nbIndividualsTotal;
        private int RATIO = 10; // How many lines to delimit a zone ?
        private List<PopulationGoal> mapGoal;
        private List<PopulationGenetic> mapGenetic;

        private int iGeneration;
        private int MAX_GENERATIONS; // How many generations max do we want to do ?
        private int MIN_FITNESS_PERCENTAGE; // How many errors do we accept ?
        private int CROSSOVER_PERCENTAGE; // What are the odds a crossover would happen ?
        private int MUTATION_PERCENTAGE; // What are the odds a mutation would happen ?
        private DateTime startTime;
        private DateTime endTime;

        public GeneticNation(Bitmap _imgGoal)
        {
            InitGeneticNation(_imgGoal);
        }

        private void InitGeneticNation(Bitmap _imgGoal)
        {
            // Init properties
            mapGoal = new List<PopulationGoal>();
            mapGenetic = new List<PopulationGenetic>();
            iGeneration = 0;

            // Get picture informations
            widthTotal = _imgGoal.Width;
            heightTotal = _imgGoal.Height;
            nbIndividualsTotal = _imgGoal.Width * _imgGoal.Height;

            // Check if the ratio is correct
            if (heightTotal > 100 && widthTotal > 100)
            {
                RATIO = 5;
            }

            // Generate populations
            int iLineStart = 0;
            int iHeight = 0;

            do
            {
                // We don't want to go out of the picture
                iHeight = (iLineStart + RATIO) > heightTotal ? (heightTotal - iLineStart) : RATIO;
                // Get the picture zone
                Rectangle zone = new Rectangle(0, iLineStart, widthTotal, iHeight);
                Bitmap bitmap = _imgGoal.Clone(zone, _imgGoal.PixelFormat);

                // Init populations
                PopulationGoal populationGoal = new PopulationGoal(bitmap);
                mapGoal.Add(populationGoal);
                PopulationGenetic populationGenetic = new PopulationGenetic(populationGoal);
                mapGenetic.Add(populationGenetic);

                iLineStart += RATIO;
            } while (iLineStart < heightTotal);
        }

        public void Evolve(RichTextBox _logs)
        {
            startTime = DateTime.Now;

            // Launch all evolving populations
            foreach(PopulationGenetic nation in mapGenetic)
            {
                nation.SetMaxGenerations(MAX_GENERATIONS);
                nation.SetMinFitnessPercentage(MIN_FITNESS_PERCENTAGE);
                nation.SetCrossoverPercentage(CROSSOVER_PERCENTAGE);
                nation.SetMutationPercentage(MUTATION_PERCENTAGE);

                int iNation = mapGenetic.IndexOf(nation);
                nation.Evolve(mapGoal[iNation], _logs, iNation);
            }

            endTime = DateTime.Now;

            // Show the statistiques
            Task.Factory.StartNew(() => _logs.Invoke(new Action(() => _logs.AppendText(GetLogs()))));
            Task.Factory.StartNew(() => _logs.Invoke(new Action(() => _logs.ScrollToCaret())));

            iGeneration++;
        }

        // Create a Bitmap with all Indviduals from all populations
        public Bitmap GetBitmap()
        {
            Bitmap bitmap = new Bitmap(widthTotal, heightTotal);
            int iPixel = 0;
            int iLine, iColumn;

            foreach (PopulationGenetic nation in mapGenetic)
            {
                IndividualColor[] individuals = nation.GetIndividuals();

                foreach (IndividualColor pixel in individuals)
                {
                    iLine = (int)Math.Floor((double)(iPixel / widthTotal));
                    iColumn = iPixel - iLine * widthTotal;
                    bitmap.SetPixel(iColumn, iLine, pixel.GetColor());

                    iPixel++;
                }
            }

            return bitmap;
        }

        #region setter

        public void SetMaxGenerations(int _maxGenerations)
        {
            MAX_GENERATIONS = _maxGenerations >= 1 ? _maxGenerations : 1;
        }

        public void SetMinFitnessPercentage(int _minFitnessPercentage)
        {
            if (_minFitnessPercentage >= 0 && _minFitnessPercentage <= 100)
            {
                MIN_FITNESS_PERCENTAGE = _minFitnessPercentage;
            }
            else
            {
                MIN_FITNESS_PERCENTAGE = 10;
            }
        }

        public void SetCrossoverPercentage(int _crossoverPercentage)
        {
            if (_crossoverPercentage >= 0 && _crossoverPercentage <= 100)
            {
                CROSSOVER_PERCENTAGE = _crossoverPercentage;
            }
            else
            {
                CROSSOVER_PERCENTAGE = 95;
            }
        }

        public void SetMutationPercentage(int _mutationPercentage)
        {
            if (_mutationPercentage >= 0 && _mutationPercentage <= 100)
            {
                MUTATION_PERCENTAGE = _mutationPercentage;
            }
            else
            {
                MUTATION_PERCENTAGE = 10;
            }
        }

        #endregion

        #region getter

        public int GetNbPopulations()
        {
            return mapGenetic.Count();
        }

        public int GetNbGenerations()
        {
            return iGeneration * MAX_GENERATIONS;
        }

        public int GetFitnessTotal()
        {
            int fitness = 0;

            foreach(PopulationGenetic nation in mapGenetic)
            {
                fitness += nation.GetFitness();
            }

            return fitness;
        }


        public string GetLogs()
        {
            string infos = "\n\n================================ GENETIC ================================\n";
            infos += "Fitness Total: " + GetFitnessTotal();
            infos += "\t\t\t\tNb Generation: " + iGeneration;
            infos += "\t\t\tDuration: " + (endTime - startTime).ToString();
            infos += "\nMAX_GENERATIONS: " + MAX_GENERATIONS;
            infos += "\t\tMIN_FITNESS_PERCENTAGE: " + MIN_FITNESS_PERCENTAGE;
            infos += "\nCROSSOVER_PERCENTAGE: " + CROSSOVER_PERCENTAGE;
            infos += "\t\tMUTATION_PERCENTAGE: " + MUTATION_PERCENTAGE;
            infos += "\n================================ GENETIC ================================\n\n";

            return infos;
        }

        #endregion
    }
}
