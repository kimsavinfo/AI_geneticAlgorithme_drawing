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
        private int nbNations;
        private int RATIO = 10;
        private List<PopulationGoal> mapGoal;
        private List<PopulationGenetic> mapGenetic;

        private int iGeneration;
        private int MAX_GENERATIONS;
        private int MIN_FITNESS_PERCENTAGE;
        private int CROSSOVER_PERCENTAGE;
        private int MUTATION_PERCENTAGE;
        private DateTime startTime;
        private DateTime endTime;

        public GeneticNation(Bitmap _imgGoal)
        {
            InitGeneticNation(_imgGoal);
        }

        private void InitGeneticNation(Bitmap _imgGoal)
        {
            mapGoal = new List<PopulationGoal>();
            mapGenetic = new List<PopulationGenetic>();
            iGeneration = 0;

            widthTotal = _imgGoal.Width;
            heightTotal = _imgGoal.Height;
            nbIndividualsTotal = _imgGoal.Width * _imgGoal.Height;
            nbNations = 0;
            int iLineStart = 0;
            int iHeight = 0;

            if(heightTotal > 100 && widthTotal > 100)
            {
                RATIO = 5;
            }

            do
            {
                iHeight = (iLineStart + RATIO) > heightTotal ? (heightTotal - iLineStart) : RATIO;
                Rectangle zone = new Rectangle(0, iLineStart, widthTotal, iHeight);
                Bitmap bitmap = _imgGoal.Clone(zone, _imgGoal.PixelFormat);

                PopulationGoal populationGoal = new PopulationGoal(bitmap);
                mapGoal.Add(populationGoal);
                PopulationGenetic populationGenetic = new PopulationGenetic(populationGoal);
                mapGenetic.Add(populationGenetic);
                
                nbNations++;
                iLineStart += RATIO;
            } while (iLineStart < heightTotal);
        }

        public void Evolve(RichTextBox _logs)
        {
            startTime = DateTime.Now;

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

            Task.Factory.StartNew(() => _logs.Invoke(new Action(() => _logs.AppendText(GetLogs()))));
            Task.Factory.StartNew(() => _logs.Invoke(new Action(() => _logs.ScrollToCaret())));

            iGeneration++;
        }

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

        public int GetNbNations()
        {
            return nbNations;
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
